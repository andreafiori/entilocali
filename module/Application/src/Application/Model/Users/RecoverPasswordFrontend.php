<?php

namespace Application\Model\Users;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  19 June 2014
 */
class RecoverPasswordFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setVariable('form', new RecoverPasswordForm() );
        
        $this->setTemplate('users/recover_password.phtml');
        
        return $this->getOutput();
    }
}
