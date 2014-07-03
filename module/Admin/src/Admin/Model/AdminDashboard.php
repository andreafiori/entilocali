<?php

namespace Admin\Model;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class AdminDashboard extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        return $this->getOutput();
    }
}
