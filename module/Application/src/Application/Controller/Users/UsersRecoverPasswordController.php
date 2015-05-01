<?php

namespace Application\Controller\Users;

use Application\Controller\SetupAbstractController;
use Application\Model\Users\RecoverPasswordForm;

/**
 * @author Andrea Fiori
 * @since  18 April 2015
 */
class UsersRecoverPasswordController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $form = new RecoverPasswordForm();

        $this->layout()->setVariables(array(
            'form'              => $form,
            'templatePartial'   => 'users/recover_password.phtml'
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    public function sendAction()
    {

    }
}