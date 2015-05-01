<?php

namespace Application\Controller;

use Application\Model\PasswordPreviewForm;
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

        $model = new ViewModel();

        if ( !isset($configurations['preview_password_area']) or $this->checkPasswordPreviewArea($configurations, $session) or !$this->hasPasswordPreviewArea($configurations) ) {
            return $this->redirect()->toRoute('main');
        }

        $form = new PasswordPreviewForm();

        $model->setVariables(array(
            'form'      => $form,
            'sitename'  => isset($configurations['sitename']) ? $configurations['sitename'] : null,
        ));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $formPost = $form->getData();
                if ($formPost['password'] == $configurations['preview_password']) {

                    $session->offsetSet('preview_area_ok', 1);
                    $session->offsetSet('preview_area_logintimeout', date("Y-m-d H:i:s"));

                    return $this->redirect()->toRoute('main');
                } else {
                    $model->setVariable('errorMessage', 'Password errata!');
                }
            }
        }

        return $model;
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