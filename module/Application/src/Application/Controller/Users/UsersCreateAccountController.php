<?php

namespace Application\Controller\Users;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Users\CreateAccountForm;
use ModelModule\Model\Users\CreateAccountFormInputFilter;

/**
 * @author Andrea Fiori
 * @since  17 April 2015
 */
class UsersCreateAccountController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $form = new CreateAccountForm();

        $request = $this->getRequest();

        if($request->isPost()) {

            $formValidator = new CreateAccountFormInputFilter();

            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {

            }
        }

        $this->layout()->setVariables(array(
            'form'              => $form,
            'templatePartial'   => 'users/registration.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * TODO:
     *      generate confirm code,
     *      insert user on db,
     *      send confirm email,
     *      log
     *      show a message
     *
     */
    public function registerAction()
    {

    }

    /**
     * Confirm user registration from email link
     *
     * TODO:
     *      recover user record from confirm code
     *      update user
     *      log
     *      show message
     *
     */
    public function confirmAction()
    {
        // $confirmCode = $this->params()->fromQuery('confirmcode');
    }
}