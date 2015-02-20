<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Admin\Model\Config\ConfigGetter;
use Admin\Model\Config\ConfigGetterWrapper;
use Application\Setup\UserInterfaceConfigurations;
use Zend\Session\Container as SessionContainer;

/**
 * @author Andrea Fiori
 * @since  04 December 2013
 */
abstract class SetupAbstractController extends AbstractActionController
{
    /**
     * @var \Application\Setup\UserInterfaceConfigurations 
     */
    protected $userInterfaceConfigurations;

    /**
     * @return \Admin\Service\AppServiceLoader
     */
    protected function recoverAppServiceLoader($channel = 1)
    {
        $appServiceLoader = $this->getServiceLocator()->get('AppServiceLoader');
        $appServiceLoader->setService('channel', $channel);
        $appServiceLoader->setController($this);
        $appServiceLoader->setupParams();
        $appServiceLoader->setupRedirect();
        $appServiceLoader->setupConfigurations(new ConfigGetterWrapper(new ConfigGetter($appServiceLoader->recoverService('entityManager'))));
        
        $this->userInterfaceConfigurations = $appServiceLoader->setupUserInterfaceConfigurations(new UserInterfaceConfigurations($appServiceLoader->getProperties()));

        return $appServiceLoader;
    }

    /**
     * @return \Application\Setup\UserInterfaceConfigurations
     */
    protected function getUserInterfaceConfigurationsArray()
    {
        return $this->userInterfaceConfigurations->getConfigurations();
    }

    /**
     * @return bool
     */
    public function checkLogin()
    {
        if (!$this->getServiceLocator()->get('AuthService')->hasIdentity()) {
            return false;
        }
        
        return true;
    }

    /**
     * @return \stdClass
     */
    protected function recoverUserDetails()
    {
        $session = new SessionContainer();

        $userDetails            = new \stdClass();
        $userDetails->id        = $session->offsetGet('id');
        $userDetails->name      = $session->offsetGet('name');
        $userDetails->surname   = $session->offsetGet('surname');
        $userDetails->role      = $session->offsetGet('role');
        $userDetails->acl       = $session->offsetGet('acl');

        return $userDetails;
    }
}
