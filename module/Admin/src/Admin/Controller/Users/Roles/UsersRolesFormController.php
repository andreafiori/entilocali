<?php

namespace Admin\Controller\Users\Roles;

use ModelModule\Model\Users\Roles\UsersRolesControllerHelper;
use ModelModule\Model\Users\Roles\UsersRolesForm;
use ModelModule\Model\Users\Roles\UsersRolesGetter;
use ModelModule\Model\Users\Roles\UsersRolesGetterWrapper;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsGetter;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsGetterWrapper;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsRelationsGetter;
use ModelModule\Model\Users\Roles\UsersRolesPermissionsRelationsGetterWrapper;
use Application\Controller\SetupAbstractController;
use Zend\Permissions\Acl\Acl;

class UsersRolesFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $lang = $this->params()->fromRoute('lang');
        $id = $this->params()->fromRoute('id');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');


        $helper = new UsersRolesControllerHelper();
        $roleRecord = $helper->recoverWrapperRecordsById(
            new UsersRolesGetterWrapper(new UsersRolesGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $permissionsWrapper = $helper->recoverWrapper(
            new UsersRolesPermissionsGetterWrapper(new UsersRolesPermissionsGetter($em)),
            array()
        );
        $permissionsRecords = $permissionsWrapper->getRecords();

        $acl = new Acl();
        $form = new UsersRolesForm();

        if ( !empty($roleRecord) ) {

            $acl->addRole($roleRecord[0]['name']);

            $permissionsCurrentRoles = new UsersRolesPermissionsRelationsGetterWrapper(
                new UsersRolesPermissionsRelationsGetter($em)
            );
            $permissionsCurrentRoles->setInput(array(
                'roleId'  => $roleRecord[0]['id'],
                'orderBy' => 'permission.position',
            ));
            $permissionsCurrentRoles->setupQueryBuilder();

            if (!empty($permissionsCurrentRolesRecords)) {
                $permissionsCurrentRolesRecords = $permissionsCurrentRoles->getRecords();
                foreach($permissionsCurrentRolesRecords as $currentRolesRecord) {
                    $acl->addResource($currentRolesRecord['flag']);
                    $acl->allow($roleRecord[0]['name'], $currentRolesRecord['flag']);
                }
            }

            $formAction      = $this->url()->fromRoute('admin/users-roles-update', array(
                'lang' => $lang
            ));
            $formTitle       = 'Modifica ruolo utente';
            $formDescription = 'Modifica dati relativi al ruolo';

            $form->setData($roleRecord[0]);
        } else {
            $formTitle       = 'Nuovo ruolo utente';
            $formDescription = 'Creazione nuovo ruolo utente';
            $formAction      =  $this->url()->fromRoute('admin/users-roles-insert', array(
                'lang' => $lang
            ));
        }

        $this->layout()->setVariables(array(
            'form'                          => $form,
            'formAction'                    => $formAction,
            'formTitle'                     => $formTitle,
            'formDescription'               => $formDescription,
            'roleName'                      => isset($roleRecord[0]['name']) ? $roleRecord[0]['name'] : null,
            'roleId'                        => isset($roleRecord[0]['id']) ? $roleRecord[0]['id'] : null,
            'permissions'                   => $permissionsWrapper->sortPerGroup($permissionsRecords),
            'acl'                           => $acl,
            'formDataCommonPath'            => 'backend/templates/common/',
            'adminAccess'                   => isset($roleRecord[0]['adminAccess']) ? $roleRecord[0]['adminAccess'] : null,
            'formBreadCrumbTitle'           => 'Modifica',
            'formBreadCrumbCategory' => array(
                array(
                    'label' => 'Utenti',
                    'href'  =>  $this->url()->fromRoute('admin/users-summary', array('lang' => $lang) ),
                    'title' => 'Elenco utenti',
                ),
                array(
                    'label' => 'Ruoli',
                    'href'  =>  $this->url()->fromRoute('admin/users-roles-summary', array('lang' => $lang)),
                    'title' => 'Elenco ruoli',
                ),
            ),
            'showRolePermissionsTemplate'   => 1,
            'templatePartial'               => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}