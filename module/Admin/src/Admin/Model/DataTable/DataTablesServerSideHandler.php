<?php

namespace Admin\Model\DataTable;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

class DataTablesServerSideHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        return $this->getOutput();
    }
}
