<?php

namespace Application\Controller;

use ModelModule\Model\PasswordPreviewForm;
use ModelModule\Model\SetupAbstractControllerHelper;
use Zend\Session\Container as SessionContainer;
use Zend\View\Model\ViewModel;

/**
 * @author Andrea Fiori
 * @since  26 February 2015
 */
class PasswordPreviewController extends SetupAbstractController
{
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');

        $session = new SessionContainer();

        if ( !isset($configurations['preview_password_area']) or $this->checkPasswordPreviewArea($configurations, $session) or !$this->hasPasswordPreviewArea($configurations) ) {
            return $this->redirect()->toRoute('main');
        }

        $request = $this->getRequest();

        $helper = new SetupAbstractControllerHelper();
        $helper->setConfigurations($configurations);
        $helper->setRequest($request);
        $helper->setupZf2appDir();
        $helper->setupAppDirRelativePath();

        $form = new PasswordPreviewForm();

        $this->layout()->setVariables(array(
            'form'      => $form,
            'sitename'  => isset($configurations['sitename']) ? $configurations['sitename'] : null,
        ));

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $formPost = $form->getData();
                if ($formPost['password'] == $configurations['preview_password']) {

                    $session->offsetSet('preview_area_ok', 1);
                    $session->offsetSet('preview_area_logintimeout', date("Y-m-d H:i:s"));

                    return $this->redirect()->toRoute('main');
                } else {
                    $this->layout()->setVariable('errorMessage', 'Password errata!');
                }
            }
        }

        $this->layout()->setVariable('publicDirRelativePath', $helper->getAppDirRelativePath().'/public');

        $this->layout()->setTemplate('frontend/projects/'.$configurations['project_frontend'].'templates/'.$configurations['template_frontend'] .'preview-area/preview-area.phtml');
    }

    /**
     * Logout from password preview area
     *
     * @return \Zend\Http\Response
     */
    public function logoutAction()
    {
        $session = new SessionContainer();
        $session->offsetUnset('preview_area_ok');
        $session->offsetUnset('preview_area_logintimeout');

        return $this->redirect()->toRoute('main');
    }
}