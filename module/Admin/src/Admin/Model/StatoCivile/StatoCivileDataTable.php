<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class StatoCivileDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $this->setTitle('Stato civile');
        $this->setDescription('Gestione atti stato civile in archivio');
        $this->setColumns(array("Titolo", "Numero / Anno", "Sezione", "Inserito il", "Scadenza", "Inserito da", "&nbsp;", "&nbsp;", "&nbsp;"));
    }

    /**
     * @return array 
     */
    public function getRecords()
    {
        $records = $this->getStatoCivileRecords( array() );
        
        if (!$records) {
            return false;
        }
        
        $recordsToReturn = array();
        foreach($records as $record) {
            $recordsToReturn[] = array(
                $record['titolo'],
                $record['progressivo'].' / '.$record['anno'],
                $record['nome'],
                $this->convertDateTimeToString($record['data']),
                $this->convertDateTimeToString($record['scadenza']),
                // ucfirst($record['status']),
                '',
                array(
                    'type'      => 'updateButton',
                    'href'      => $this->getInput('baseUrl',1).'formdata/stato-civile/'.$record['id'],
                    'tooltip'   => 1,
                    'title'     => 'Modifica'
                ),
                array(
                    'type'      => 'attachButton',
                    'href'      => '#',
                    'tooltip'   => 1,
                ),
                array(
                    'type'      => 'enteterzoButton',
                    'href'      => '#',
                    'tooltip'   => 1,
                    'title'     => 'Modifica'
                ),
            );
        }

        return $recordsToReturn;
    }
    
        /**
         * @param type $input
         */
        private function getStatoCivileRecords($input = array())
        {
            $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager',1)) );
            $statoCivileGetterWrapper->setInput($input);
            $statoCivileGetterWrapper->setupQueryBuilder();

            return $statoCivileGetterWrapper->getRecords();
        }
}
