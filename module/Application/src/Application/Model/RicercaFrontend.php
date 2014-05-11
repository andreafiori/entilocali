<?php

namespace Application\Model;

use Application\Model\FrontendHelpers\FrontendRouterAbstract;
use Application\Model\FrontendHelpers\FrontendRouterInterface;

/**
 * Frontend class for the research
 * 
 * @author Andrea Fiori
 * @since  11 May 2014
 */
class RicercaFrontend extends FrontendRouterAbstract implements FrontendRouterInterface
{
    public function setupFrontendRecord()
    {
        $request  = $this->getInput('request', 1);
        $redirect = $this->getInput('redirect', 1);
        $formData = $request->getPost();
        
        if ( $request->isPost() ) {
            $this->setTemplate('ricerca/ricerca.phtml');
            
            return $this->getOutput();
        }

        $redirect->toRoute('home');
    }
}
