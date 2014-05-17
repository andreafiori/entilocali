<?php

namespace Application\Model\Ricerca;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * Frontend class for the research
 * TODO: form ricerca avanzata
 * 
 * @author Andrea Fiori
 * @since  11 May 2014
 */
class RicercaFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $request  = $this->getInput('request', 1);
        $redirect = $this->getInput('redirect', 1);
        $formData = $request->getPost();
        
        if (!is_object($request)) {
            return false;
        }
        
        if ( $request->isPost() ) {
            $this->setTemplate('ricerca/ricerca.phtml');
            
            return $this->getOutput();
        }

        $redirect->toRoute('home');
    }
}
