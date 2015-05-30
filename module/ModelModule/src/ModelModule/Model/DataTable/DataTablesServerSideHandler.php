<?php

namespace ModelModule\Model\DataTable;

use ModelModule\Model\RouterManagers\RouterManagerAbstract;
use ModelModule\Model\RouterManagers\RouterManagerInterface;

class DataTablesServerSideHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        return $this->getOutput();
    }
}
