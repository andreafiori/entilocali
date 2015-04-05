<?php

namespace Admin\Model\DataTable;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

class DataTablesHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setTemplate('datatables/datatables-client-side.phtml');

        return $this->getOutput();
    }
}
