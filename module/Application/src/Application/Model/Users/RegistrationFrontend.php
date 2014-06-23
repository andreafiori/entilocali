<?php

namespace Application\Model\Users;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * Sign up form
 *  
 * @author Andrea Fiori
 * @since  25 May 2014
 */
class RegistrationFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setVariable('form', new RegistrationForm() );
        
        $this->setTemplate('users/registration.phtml');
        
        return $this->getOutput();
    }
}
