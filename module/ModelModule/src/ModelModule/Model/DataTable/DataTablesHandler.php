<?php

namespace ModelModule\Model\DataTable;

use ModelModule\Model\RouterManagers\RouterManagerAbstract;
use ModelModule\Model\RouterManagers\RouterManagerInterface;

class DataTablesHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setTemplate('datatables/datatables-client-side.phtml');

        return $this->getOutput();
    }
}
