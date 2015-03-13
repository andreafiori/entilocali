<?php

namespace Application\Model\SearchEngine;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 *
 * TODO:
 *      ricerca selettiva sui principali record (se è attivo il modulo...)
 *
 *      contenuti
 *      amministrazione-trasparente
 *      albo pretorio
 *      stato civile
 *      atti concessione
 *      contratti
 *      blogs
 *
 * @author Andrea Fiori
 * @since  11 May 2014
 */
class SearchEngineFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $request  = $this->getInput('request', 1);

        $redirect = $this->getInput('redirect', 1);

        // $formData = $request->getPost();
        
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
