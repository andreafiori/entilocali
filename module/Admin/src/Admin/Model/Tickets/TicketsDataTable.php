<?php

namespace Admin\Model\Tickets;

use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class TicketsDataTable extends DataTableAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
                
        $this->setTitle('Assistenza');

        $this->setDescription('Consulta le assistenze in archivio');

        $this->setColumns(array(
                "Oggetto",
                "Messaggio",
                "Priorit&agrave;",
                "Creato il"
            )
        );
    }
    
    public function getRecords()
    {
        $records = $this->recoverTicketRecords();

        if ( is_array($records) ) {
            $arrayToReturn = array();
            foreach($records as $record) {

                $arrayToReturn[] = array(
                    isset($record['title']) ? $record['title'] : null,
                    isset($record['subject']) ? $record['subject'] : null,
                    isset($record['priority']) ? $record['priority'] : null,
                    isset($record['createDate']) ? $record['createDate'] : null,
                );
            }

            return $arrayToReturn;
        }
        
        return false;
    }

    /**
     * @return \Application\Model\QueryBuilderHelperAbstract
     * @throws \Application\Model\NullException
     */
    private function recoverTicketRecords($input = array())
    {
        $wrapper = new TicketsGetterWrapper(new TicketsGetter($this->getInput('entityManager', 1)));
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        return $wrapper->getRecords();
    }
}
