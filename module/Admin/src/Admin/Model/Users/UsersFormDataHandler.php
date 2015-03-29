<?php

namespace Admin\Model\Users;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Users\Roles\UsersRolesGetter;
use Admin\Model\Users\Roles\UsersRolesGetterWrapper;
use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  15 June 2013
 */
class UsersFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getInput('param', 1);

        if (isset($param['route']['option'])) {
            $records = $this->getUserRecord($param['route']['option']);
        }

        $form = new UsersForm();
        if ($this->getAcl()->hasResource('users_roles_update')) {
            $form->addRoles($this->getRolesRecords());
        }

        if ($this->getAcl()->hasResource('users_settori_update')) {
            $form->addSettori($this->getSettoriRecords());
        }

        if (!empty($records)) {
            $formAction      = 'users/update/'.$records[0]['id'];
            $formTitle       = 'Modifica utente';
            $formDescription = 'Modifica dati utente';

            $form->setData($records[0]);
        } else {

            // Check ACL
            if( !$this->isRole(array('SuperAdmin','WebMaster')) ) {
                $redirect = $this->getInput('redirect',1);
                return $redirect->toRoute('admin', array('lang' => 'it'));
            }

            $formTitle       = 'Nuovo utente';
            $formDescription = 'Creazione nuovo utente.';
            $formAction      = 'users/insert/';
        }

        $this->setVariables(array(
                'form'              => $form,
                'formTitle'         => $formTitle,
                'formDescription'   => $formDescription,
                'formAction'        => $formAction,
                'formBreadCrumbCategory' => 'Utenti',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl',1).'datatable/users',
            )
        );
    }

        /**
         * @param number $idUser
         * @return boolean
         */
        private function getUserRecord($idUser)
        {
            if ( !is_numeric($idUser) ) {
                return false;
            }
            
            $wrapper = new UsersGetterWrapper( new UsersGetter($this->getInput('entityManager', 1)) );
            $wrapper->setInput( array("id" => $idUser) );
            $wrapper->setupQueryBuilder();
            
            return $wrapper->getRecords();
        }

        /**
         * @return array
         */
        private function getRolesRecords()
        {
            $wrapper = new UsersRolesGetterWrapper( new UsersRolesGetter($this->getInput('entityManager', 1)) );
            $wrapper->setInput( array() );
            $wrapper->setupQueryBuilder();

            $rolesRecords = $wrapper->getRecords();
            if (!empty($rolesRecords)) {
                $toReturn = array();
                foreach($rolesRecords as $rolesRecord) {
                    $toReturn[$rolesRecord['id']] = $rolesRecord['name'];
                }
                return $toReturn;
            }

            return false;
        }

        /**
         * @return array
         */
        private function getSettoriRecords()
        {
            $wrapper = new UsersSettoriGetterWrapper( new UsersSettoriGetter($this->getInput('entityManager', 1)) );
            $wrapper->setInput( array() );
            $wrapper->setupQueryBuilder();

            $rolesRecords = $wrapper->getRecords();
            if (!empty($rolesRecords)) {
                $toReturn = array();
                foreach($rolesRecords as $rolesRecord) {
                    $toReturn[$rolesRecord['id']] = $rolesRecord['nome'];
                }
                return $toReturn;
            }

            return false;
        }
}