<?php

namespace Application\Controller;

use Admin\Service\AppServiceLoader;
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
     * @return \Admin\Service\AppServiceLoader
     */
    protected function recoverAppServiceLoader($channel = 1)
    {
        $sl = $this->getServiceLocator();
        $em = $sl->get('Doctrine\ORM\EntityManager');
        $sm = $sl->get('servicemanager');

        $appServiceLoader = new AppServiceLoader();

        $appServiceLoader->setProperties( array(
            'serviceLocator'    => $sl,
            'serviceManager'    => $sm,
            'entityManager'     => $em,
            'queryBuilder'      => $em->createQueryBuilder(),
            'translator'        => $sm->get('translator'),
            'moduleConfigs'     => $sm->get('config'),
            'request'           => $sm->get('request'),
            'router'            => $sm->get('request'),
        ));
        $appServiceLoader->recoverRouter();
        $appServiceLoader->recoverRouteMatch();
        $appServiceLoader->setService('channel', $channel);
        $appServiceLoader->setController($this);
        $appServiceLoader->setupParams();
        $appServiceLoader->setupRedirect();
        $appServiceLoader->setupConfigurations(
            new ConfigGetterWrapper(
                new ConfigGetter($appServiceLoader->recoverService('entityManager'))
            )
        );
        $appServiceLoader->setupUserInterfaceConfigurations(
            new UserInterfaceConfigurations($appServiceLoader->recoverService('configurations'))
        );

        return $appServiceLoader;
    }

    /**
     * Check parameters for the password preview area
     *
     * @param array $configurations
     * @param SessionContainer $sessionContainer
     *
     * @return bool
     */
    public function checkPasswordPreviewArea(array $configurations, SessionContainer $sessionContainer)
    {
        if (!$this->hasPasswordPreviewArea($configurations)) {
            return true;
        }

        if ( isset($configurations['preview_password_area']) and $sessionContainer->offsetGet('preview_area_ok')!=1) {
            return false;
        } else {
            $dateDiff = date_diff(
                date_create($sessionContainer->offsetGet('preview_area_logintimeout')),
                date_create(date("Y-m-d H:i:s"))
            );

            if ($dateDiff->i > 60) {

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
     * @return \stdClass
     */
    protected function recoverUserDetails()
    {
        $session = new SessionContainer();

        $userDetails                            = new \stdClass();
        $userDetails->id                        = $session->offsetGet('id');
        $userDetails->name                      = $session->offsetGet('name');
        $userDetails->surname                   = $session->offsetGet('surname');
        $userDetails->role                      = $session->offsetGet('role');
        $userDetails->acl                       = $session->offsetGet('acl');
        $userDetails->salt                      = $session->offsetGet('salt');
        $userDetails->passwordLastUpdate        = $session->offsetGet('passwordLastUpdate');

        return $userDetails;
    }
}
