<?php

namespace Feed\Model;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  01 March 2015
 */
class AlboPretorioFeedResource extends FeedBuilderAbstract
{
    public function __construct()
    {
        $this->setTitle('Albo pretorio');
        $this->setFeedLink('http://www.kronoweb.it');
        $this->setLink('http://www.kronoweb.it');
        $this->setDescription('Ultimi atti albo pretorio ');
    }

    /**
     * @param array $input
     * @throws \Application\Model\NullException
     */
    public function recoverRecords()
    {
        $wrapper = new AlboPretorioArticoliGetterWrapper( new AlboPretorioArticoliGetter($this->getInput('entityManager', 1)) );

        $wrapper->setInput(array(
            'fields'        => 'aa.titolo AS title, aa.titolo AS content, aa.dataPubblicare AS date_created ',
            'attivo'        => 1,
            'pubblicare'    => 1,
            'noScaduti'     => 1,
            'orderBy'       => 'aa.id DESC',
            'limit'         => $this->getNumbersOfEntries()
        ));
        $wrapper->setupQueryBuilder();

        return $wrapper->getRecords();
    }

    /**
     * @param array $records
     * @return array
     */
    public function formatRecords(array $records)
    {
        foreach($records as &$record) {
            $record['link'] = $this->getFeedLink();
            $record['date_created'] = $record['date_created']->format("Y-m-d H:i:s");
            $record['date_modified'] = $record['date_created'];
        }

        return $records;
    }
}
