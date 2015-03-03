<?php

namespace Admin\Model\Contacts;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  10 June 2014
 */
class ContactsDataTable extends DataTableAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->setTitle('Contatti');
        $this->setDescription('Elenco messaggi ricevuti dal modulo contatti');
        $this->setColumns(array("Nome e cognome", "Email", "Data invio", "&nbsp;"));
    }

    public function getRecords()
    {
        $wrapper = new ContactsGetterWrapper( new ContactsGetter($this->getInput('entityManager',1)) );
        $wrapper->setupQueryBuilder();
        
        return $this->buildDataTableRows( $wrapper->getRecords() );
    }

        /**
         * @param array $records
         * @return array
         */
        private function buildDataTableRows($records)
        {
            if (empty($records)) {
                return false;
            }

            $recordsToReturn = array();
            foreach($records as $record) {
                $recordsToReturn[] = array(
                    $record['name'].' '.$record['surname'],
                    $record['email'],
                    $this->convertDateTimeToString($record['insertDate']),
                    array(
                        'id' => 'deleteButton',
                        'type'      => 'deleteButton',
                        'title'     => 'Elimina',
                        'href'      => '#',
                        'data-id'   => $record['id'],
                    ),
                );
            }
            
            return $recordsToReturn;
        }
}
