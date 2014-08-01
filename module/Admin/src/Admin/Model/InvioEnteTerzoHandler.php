<?php

namespace Admin\Model;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * TODO: detect modul
 * 
 * @author Andrea Fiori
 * @since  30 July 2014
 */
class InvioEnteTerzoHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);
        
        $this->setTemplate('invio-ente-terzo/invio-ente-terzo.phtml');
        
        return $this->getOutput();
    }
}
