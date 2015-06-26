<?php

namespace Auth\Controller;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\SetupAbstractControllerHelper;
use ModelModule\Model\Users\RecoverPasswordForm;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;

/**
 * TODO: form recover password, validate form, send email with request, confirm received request selecting confirm code
 */
class RecoverPasswordController extends SetupAbstractController
{
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');

        $templateBackend = $appServiceLoader->recoverServiceKey('configurations', 'template_backend');

        $request = $this->getRequest();

        $helper = new SetupAbstractControllerHelper();
        $helper->setConfigurations($configurations);
        $helper->setRequest($request);
        $helper->setupZf2appDir();
        $helper->setupAppDirRelativePath();

        $form = new RecoverPasswordForm();
        $form->addSubmitButton();

        $this->layout()->setVariables(
            array(
                'configurations'        => $configurations,
                'publicDirRelativePath' => $helper->getAppDirRelativePath().'/public',
                'form'                  => $form,
            )
        );

        return $this->layout('backend/templates/'.$templateBackend.'recover-password.phtml');
    }


    public function recoverAction()
    {

    }

    public function confirmAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $configurations = $appServiceLoader->recoverService('configurations');

        $templateBackend = $appServiceLoader->recoverServiceKey('configurations', 'template_backend');

        $request = $this->getRequest();

        $helper = new SetupAbstractControllerHelper();
        $helper->setConfigurations($configurations);
        $helper->setRequest($request);
        $helper->setupZf2appDir();
        $helper->setupAppDirRelativePath();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $wrapper = new UsersGetterWrapper(new UsersGetter($em));

        $form = new RecoverPasswordForm();
        $form->addSubmitButton();

        $this->layout()->setVariables(
            array(
                'configurations'        => $configurations,
                'publicDirRelativePath' => $helper->getAppDirRelativePath().'/public',
                'form'                  => $form,
            )
        );

        return $this->layout('backend/templates/'.$templateBackend.'recover-password-confirm.phtml');
    }
}