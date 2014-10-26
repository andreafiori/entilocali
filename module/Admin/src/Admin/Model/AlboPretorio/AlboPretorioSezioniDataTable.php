<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class AlboPretorioSezioniDataTable extends DataTableAbstract implements DataTableInterface
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->setTitle('Sezioni albo pretorio');
        $this->setDescription('Elenco sezioni albo pretorio.');
        $this->setColumns( array('Nome', '&nbsp;') );
    }
    
    /**
     * @return array|null
     */
    public function getRecords()
    {   
        return $this->formatRecords($this->recoverRecords(new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($this->getInput('entityManager',1)))));
    }
    
    /**
     * Recover albo sezioni records from db
     * 
     * @param AlboPretorioSezioniGetterWrapper $alboPretorioGetterWrapper
     * @param array|null $input
     */
    public function recoverRecords(AlboPretorioSezioniGetterWrapper $alboPretorioGetterWrapper, $input = array())
    {
        $alboPretorioGetterWrapper->setInput($input);
        $alboPretorioGetterWrapper->setupQueryBuilder();

        return $alboPretorioGetterWrapper->getRecords();
    }
    
    /**
     * Format recors to show on the view
     * 
     * @return array
     */
    public function formatRecords(array $records)
    {        
        if (is_array($records)) {
            $arrayToReturn = array();
            foreach($records as $record) {
                $arrayToReturn[] = array(
                    $record['nome'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/albo-pretorio-sezioni/'.$record['id'],
                        'tooltip'   => 1,
                        'title'     => 'Modifica'
                    ),
                );
            }
        }

        return $arrayToReturn;
    }
}
