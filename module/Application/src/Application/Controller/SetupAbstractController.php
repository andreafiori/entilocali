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
        $session = new SessionContainer();

        if ( !$this->getServiceLocator()->get('AuthService')->hasIdentity() or $session->offsetGet('sitename') != $this->recoverSitename()) {
            return false;
        }

        return true;
    }

    /**
     * Check parameters for the password preview area
     *
     * @param array $configurations
     * @param SessionContainer $sessionContainer
     * @return bool
     */
    public function checkPasswordPreviewArea(array $configurations, SessionContainer $sessionContainer)
    {
        if (!$this->hasPasswordPreviewArea($configurations)) {
            return true;
        }

        if ( isset($configurations['preview_password_area']) and $sessionContainer->offsetGet('preview_area_ok')!==1) {
            return false;
        } else {
            $dateDiff = date_diff( date_create($sessionContainer->offsetGet('preview_area_logintimeout')), date_create(date("Y-m-d H:i:s")) );
            if ($dateDiff->i > 80) {

                $sessionContainer->offsetUnset('preview_area_ok');
                $sessionContainer->offsetUnset('preview_area_logintimeout');

                return false;
            }
        }

        return true;
    }

    /**
     * Check if the password preview area is activated
     *
     * @param array $configurations
     * @return bool
     */
    public function hasPasswordPreviewArea(array $configurations)
    {
        if ( isset($configurations['preview_password_area']) and $configurations['preview_password_area']==1) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    protected function recoverSitename()
    {
        $configGetterWrapper = new ConfigGetterWrapper(new ConfigGetter($this->getServiceLocator()->get('doctrine.entitymanager.orm_default')));
        $configGetterWrapper->setInput(array(
            'name'      => 'sitename',
            'channel'   => 1,
            'language'  => 1,
            'limit'     => 1
        ));
        $configGetterWrapper->setupQueryBuilder();

        $records = $configGetterWrapper->getRecords();

        if (empty($records)) {
            return false;
        }

        return $records[0]['value'];
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
