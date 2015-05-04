<?php

namespace Admin\Controller\Users;

use Admin\Model\Users\Roles\UsersRolesGetter;
use Admin\Model\Users\Roles\UsersRolesGetterWrapper;
use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;
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

        if ( is_numeric($id) ) {
            $wrapper = new UsersGetterWrapper( new UsersGetter($em) );
            $wrapper->setInput( array("id" => $id) );
            $wrapper->setupQueryBuilder();

            $records =  $wrapper->getRecords();
        }

        $form = new UsersForm();
        if ($userDetails->acl->hasResource('users_roles_update')) {
            $wrapper = new UsersRolesGetterWrapper( new UsersRolesGetter($em) );
            $wrapper->setInput( array() );
            $wrapper->setupQueryBuilder();

            $rolesRecords = $wrapper->getRecords();
            if (!empty($rolesRecords)) {
                $toReturn = array();
                foreach($rolesRecords as $rolesRecord) {
                    $toReturn[$rolesRecord['id']] = $rolesRecord['name'];
                }

            }

            $form->addRoles($toReturn);
        }

        if ($userDetails->acl->hasResource('users_settori_update')) {
            $wrapper = new UsersSettoriGetterWrapper( new UsersSettoriGetter($em) );
            $wrapper->setInput( array() );
            $wrapper->setupQueryBuilder();

            $rolesRecords = $wrapper->getRecords();
            if (!empty($rolesRecords)) {
                $toReturn = array();
                foreach($rolesRecords as $rolesRecord) {
                    $toReturn[$rolesRecord['id']] = $rolesRecord['nome'];
                }
            }

            $form->addSettori($toReturn);
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