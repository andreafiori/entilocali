<?php

namespace Admin\Model\Tickets;

use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\Tickets\TicketsGetter;
use Admin\Model\Tickets\TicketsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class TicketsDataTable extends DataTableAbstract
{
    
    public function __construct(array $input)
    {
        parent::__construct($input);
                
        $this->setTitle('Assistenza');
        $this->setDescription('Consulta le assistenze in archivio');
        $this->setColumns(array("title", "subject", "priority", ""));
    }
    
    public function getRecords()
    {
        $ticketsGetterWrapper = new TicketsGetterWrapper( new TicketsGetter($this->getInput('entityManager',1)) );
        $ticketsGetterWrapper->setInput( array() );
        $ticketsGetterWrapper->setupQueryBuilder();
        
        $records = $ticketsGetterWrapper->getRecords();
        if ($records) {
            $arrayToReturn = array();
            foreach($records as $record) {
                
                if (!isset($record['title'])) {
                    break;
                }
                
                $arrayToReturn[] = array(
                    $record['title'],
                    $record['subject'],
                    $record['priority'],
                    ''
                );
            }
            return $arrayToReturn;
        }
        
        return false;
    }

        private function setNotFoundDataVars()
        {
            $this->setVariable('messageTitle', 'Nessuna richiesta di assistenza in archivio');
            $this->setVariable('messageDescription', 'Nessuna richiesta di assistenza &egrave; stata aperta e gestita');
        }
}
