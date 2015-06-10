<?php

namespace Admin\Controller\Users;

use ModelModule\Model\Users\Roles\UsersRolesGetter;
use ModelModule\Model\Users\Roles\UsersRolesGetterWrapper;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use ModelModule\Model\Users\UsersControllerHelper;
use ModelModule\Model\Users\UsersForm;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;
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
        $records = $helper->recoverWrapperRecordsById(
            new UsersGetterWrapper(new UsersGetter($em)),
            array(
                'id' => $id,
                'limit' => 1
            ),
            $id
        );

        $form = new UsersForm();
        if (!empty($records)) {
            $form->addPasswords();
        } else {
            $form->addPasswordsMandatory();
        }

        /* Check roles permission */
        if ($userDetails->acl->hasResource('users_roles_update')) {
            $rolesRecords = $helper->recoverWrapperRecords(
                new UsersRolesGetterWrapper(new UsersRolesGetter($em)),
                array()
            );
            $rolesRecordsForDropDown = $helper->formatForDropwdown($rolesRecords, 'id', 'name');

            $form->addRoles($rolesRecordsForDropDown);
        }

        /* Check settori permission */
        if ($userDetails->acl->hasResource('users_settori_update')) {

            $settoriRecords = $helper->recoverWrapperRecords(
                new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)),
                array()
            );
            $settoriRecordsForDropDown = $helper->formatForDropwdown($settoriRecords, 'id', 'nome');

            $form->addSettori($settoriRecordsForDropDown);
        }

        if (!empty($records)) {
            $formAction      = $this->url()->fromRoute('admin/users-update', array(
                'lang' => $this->params()->fromRoute('lang'),
            ));

            $formTitle       = 'Modifica utente';
            $formDescription = 'Modifica dati utente';

            $form->setData($records[0]);
        } else {
            $formAction      = $this->url()->fromRoute('admin/users-insert', array(
                'lang' => $this->params()->fromRoute('lang'),
            ));

            $formTitle       = 'Nuovo utente';
            $formDescription = 'Creazione nuovo utente';
        }

        $this->layout()->setVariables(array(
            'form'                          => $form,
            'formTitle'                     => $formTitle,
            'formDescription'               => $formDescription,
            'formAction'                    => $formAction,
            'formBreadCrumbCategory'        => 'Utenti',
            'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/users-summary', array(
                'lang' => $this->params()->fromRoute('lang')
            )),
            'noFormActionPrefix'            => 1,
            'templatePartial'               => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}