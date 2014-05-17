<?php

namespace Application\Model\StatoCivile;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class StatoCivileFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {    
        $this->setTemplate('stato-civile/index.phtml');
        
        return $this->getOutput();
    }
}
