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
        $this->setColumns(array("Oggetto", "Priorit&agrave;", ""));
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

                $arrayToReturn[] = array(
                    $record['subject'],
                    $record['priority'],
                    $record['status'],
                    ''
                );
            }
            return $arrayToReturn;
        }
        
        return false;
    }
}
