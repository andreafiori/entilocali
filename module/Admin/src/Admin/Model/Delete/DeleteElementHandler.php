<?php

namespace Admin\Model\Delete;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\Contenuti\ContenutiCrudHandler;
use Admin\Model\Logs\LogsWriter;

/**
 * @author Andrea Fiori
 * @since  19 February 2015
 */
class DeleteElementHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param',1);

        switch($param['route']['type']) {
            case("contenuti"):
                $crudHandler = new ContenutiCrudHandler($this->getInput());
                $crudHandler->setConnection($this->getInput('entityManager',1)->getConnection());
                $crudHandler->setOperation('delete');
                $crudHandler->setLogsWriter( new LogsWriter($crudHandler->getConnection()) );
                // $crudHandler->delete();

                $output = $crudHandler->getOutput('export');
            break;

            case("sezioni"):

            break;

            case("sottosezioni"):

            break;

            case("enti-terzi"):

            break;
        }

        /**
         * read the type of element to delete (GET)
         * read the ID of the element to delete (POST)
         * use the crudHandler to delete element
         * redirect to list
         */
        $this->setTemplate('delete/delete-element.phtml');

        return $this->getOutput();
    }
}