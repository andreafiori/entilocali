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

/**
 * Users form controller
 */
class UsersFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $userDetails = $this->layout()->getVariable('userDetails');

        /* Check user ID and UPDATE permission */
        if ($userDetails->id != $id and !$userDetails->acl->hasResource('users_update') and $id!='') {
            return $this->redirect()->toRoute('admin/not-authorized', array('lang' => 'it'));
        }
        /* Check user ID and INSERT permission */
        if ($id=='' and !$userDetails->acl->hasResource('users_add')) {
            return $this->redirect()->toRoute('admin/not-authorized', array('lang' => 'it'));
        }

        $helper = new UsersControllerHelper();
        $records = $helper->recoverWrapperRecordsById(
            new UsersGetterWrapper(new UsersGetter($em)),
            array(
                'id'    => $id,
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

        /* Check Roles permission */
        if ($userDetails->acl->hasResource('users_roles_update')) {
            $rolesRecords = $helper->recoverWrapperRecords(
                new UsersRolesGetterWrapper(new UsersRolesGetter($em)),
                array()
            );
            $rolesRecordsForDropDown = $helper->formatForDropwdown($rolesRecords, 'id', 'name');

            $form->addRoles($rolesRecordsForDropDown);
        }

        /* Check Settori permission */
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
                'lang' => $lang,
            ));

            $formTitle       = 'Modifica utente';
            $formDescription = 'Modifica dati utente. Per creare una <strong>password sicura</strong>, scegliere una string lunga almeno 8 caratteri e che contenga caratteri speciali, lettere maiuscole e\o minuscole e numeri.';

            $form->setData($records[0]);
        } else {
            $formAction      = $this->url()->fromRoute('admin/users-insert', array('lang' => $lang));

            $formTitle       = 'Nuovo utente';
            $formDescription = 'Creazione nuovo utente. Per creare una <strong>password sicura</strong>, scegliere una string lunga almeno 8 caratteri e che contenga caratteri speciali, lettere maiuscole e\o minuscole e numeri.';
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
            'templatePartial'               => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}