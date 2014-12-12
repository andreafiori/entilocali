<?php

namespace Application\Model\AmministrazioneTrasparente;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class AmministrazioneTrasparenteFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {    
        $this->setTemplate('amministrazione-trasparente/amministrazione-trasparente.phtml');
        
        return $this->getOutput();
    }
}
