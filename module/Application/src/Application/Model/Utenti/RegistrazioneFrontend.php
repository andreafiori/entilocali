<?php

namespace Application\Model\Utenti;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * Sign up form
 *  
 * @author Andrea Fiori
 * @since  25 May 2014
 */
class RegistrazioneFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setVariable('form', new RegistrazioneForm() );
        $this->setTemplate('utenti/registrati.phtml');
        
        return $this->getOutput();
    }
}
