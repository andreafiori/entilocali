<?php

namespace Admin\Model\Users\Roles;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Zend\Permissions\Acl\Acl;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);

        // $this->checkFormPost(isset($param['post']) ? $param['post'] : null);

        $roleRecord = $this->recoverRoleRecords(isset($param['route']['roleId']) ? $param['route']['roleId'] : null);

        $permissionsWrapper = $this->recoverPermissionsWrapper(array());
        $permissionsRecords = $permissionsWrapper->getRecords();

        $acl = new Acl();

        $form = new UsersRolesForm();

        if ( !empty($roleRecord) ) {

            if ($roleRecord[0]['name'] === 'WebMaster') {
                $redirect = $this->getInput('redirect', 1);
                return $redirect->toRoute('admin', array('lang' => 'it'));
            }

            $acl->addRole($roleRecord[0]['name']);

            $permissionsCurrentRoles = new UsersRolesPermissionsRelationsGetterWrapper(
                new UsersRolesPermissionsRelationsGetter($this->getInput('entityManager',1))
            );
            $permissionsCurrentRoles->setInput(array(
                    'roleId'    => $roleRecord[0]['id'],
                    'orderBy'   => 'permission.position',
                )
            );
            $permissionsCurrentRoles->setupQueryBuilder();

            $permissionsCurrentRolesRecords = $permissionsCurrentRoles->getRecords();
            foreach($permissionsCurrentRolesRecords as $currentRolesRecord) {
                $acl->addResource($currentRolesRecord['flag']);
                $acl->allow($roleRecord[0]['name'], $currentRolesRecord['flag']);
            }

            $formAction      = 'users-roles/update/'.$roleRecord[0]['id'];
            $formTitle       = 'Modifica ruolo utente';
            $formDescription = 'Modifica dati relativi al ruolo';

            $form->setData($roleRecord[0]);
        } else {
            $formTitle       = 'Nuovo ruolo utente';
            $formDescription = 'Creazione nuovo ruolo utente.';
            $formAction      = 'users-roles/insert/';
        }

        $this->setVariables(array(
            'form'               => $form,
            'formAction'         => $formAction,
            'formTitle'          => $formTitle,
            'formDescription'    => $formDescription,
            'roleName'           => $roleRecord[0]['name'],
            'roleId'             => $roleRecord[0]['id'],
            'permissions'        => $permissionsWrapper->sortPerGroup($permissionsRecords),
            'acl'                => $acl,
            'formDataCommonPath' => 'backend/templates/common/',
            'adminAccess'        => $roleRecord[0]['adminAccess'],
        ));

        $this->setTemplate('users/roles-permissions-handler.phtml');

        return null;
    }

        /**
         * @return \Application\Model\QueryBuilderHelperAbstract
         */
        private function recoverRoleRecords($id)
        {
            if (is_numeric($id)) {
                $wrapper = new UsersRolesGetterWrapper(new UsersRolesGetter($this->getInput('entityManager',1)) );
                $wrapper->setInput( array('id' => $id, 'limit' => 1) );
                $wrapper->setupQueryBuilder();

                return $wrapper->getRecords();
            }

            return false;
        }

        /**
         * @param array $input
         * @return UsersRolesPermissionsGetterWrapper
         */
        private function recoverPermissionsWrapper($input = array())
        {
            $wrapper = new UsersRolesPermissionsGetterWrapper(
                new UsersRolesPermissionsGetter($this->getInput('entityManager',1))
            );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            return $wrapper;
        }

        /**
         * @param array|null $formPost
         * @return bool

        private function checkFormPost($formPost)
        {
            $crudHandler =  new UsersRolesPermissionsCrudHandler($this->getInput());
            $crudHandler->setConnection($this->getInput('entityManager')->getConnection());

            if (!empty($formPost['id'])) {

                $crudHandler->setOperation('update');

                $crudHandler->update();

            } else {

                $crudHandler->setOperation('insert');

                $crudHandler->insert();

            }
        } */
}
