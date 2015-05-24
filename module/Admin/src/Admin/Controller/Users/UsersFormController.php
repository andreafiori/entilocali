<?php

namespace Admin\Controller\Users;

use Admin\Model\Users\Roles\UsersRolesGetter;
use Admin\Model\Users\Roles\UsersRolesGetterWrapper;
use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;
use Admin\Model\Users\UsersControllerHelper;
use Admin\Model\Users\UsersForm;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Application\Controller\SetupAbstractController;

class UsersFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $userDetails = $this->layout()->getVariable('userDetails');

        $helper = new UsersControllerHelper();
        $helper->setUsersGetterWrapper( new UsersGetterWrapper(new UsersGetter($em)) );
        $helper->setupUsersGetterWrapperRecords(array(
                'id' => (is_numeric($id)) ? $id : 0,
                'limit' => 1
            )
        );
        $helper->setUsersSettoriGetterWrapper( new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)) );

        $records = $helper->getUsersGetterWrapperRecords();


        $form = new UsersForm();
        if ($userDetails->acl->hasResource('users_roles_update')) {

            $helper->setUsersRolesGetterWrapper( new UsersRolesGetterWrapper(new UsersRolesGetter($em)) );
            $helper->setupUsersRolesGetterWrapperRecords();
            $helper->formatUsersRolesGetterWrapperRecordsForDropdown();

            $form->addRoles($helper->getUsersRolesGetterWrapperRecords());
        }

        if ($userDetails->acl->hasResource('users_settori_update')) {

            $helper->setUsersSettoriGetterWrapper( new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)) );
            $helper->setupUsersSettoriGetterWrapperRecords( array() );
            $helper->formatUsersSettoriGetterWrapperRecordsForDropdown();

            $form->addSettori( $helper->getUsersSettoriGetterWrapperRecords() );
        }

        if (!empty($records)) {
            $formAction      = 'users/update/'.$records[0]['id'];
            $formTitle       = 'Modifica utente';
            $formDescription = 'Modifica dati utente';

            $form->setData($records[0]);
        } else {
            $formTitle       = 'Nuovo utente';
            $formDescription = 'Creazione nuovo utente.';
            $formAction      = 'users/insert/';
        }

        $this->layout()->setVariables(array(
                'form'                          => $form,
                'formTitle'                     => $formTitle,
                'formDescription'               => $formDescription,
                'formAction'                    => $formAction,
                'formBreadCrumbCategory'        => 'Utenti',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/users-summary', array('lang' => 'it')),
                'templatePartial'               => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}