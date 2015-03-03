<?php

namespace Admin\Model\Users;

use Admin\Model\FormData\FormDataAbstract;

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
        if (!empty($records)) {
            $formAction      = 'users/update/'.$records[0]['id'];
            $formTitle       = 'Modifica utente';
            $formDescription = 'Modifica dati utente.';

            $form->setData($records[0]);
        } else {
            $formTitle       = 'Nuovo utente';
            $formDescription = 'Creazione nuovo utente.';
            $formAction      = 'users/insert/';
        }

        $this->setVariable('form',              $form);
        $this->setVariable('formTitle',         $formTitle);
        $this->setVariable('formDescription',   $formDescription);
        $this->setVariable('formAction',        $formAction);
        $this->setVariable('formBreadCrumbCategory',    'Utenti');
        $this->setVariable('formBreadCrumbCategoryLink', $this->getInput('baseUrl',1).'datatable/users');
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
            
            $usersGetterWrapper = new UsersGetterWrapper( new UsersGetter($this->getInput('entityManager', 1)) );
            $usersGetterWrapper->setInput( array("id" => $idUser) );
            $usersGetterWrapper->setupQueryBuilder();
            
            return $usersGetterWrapper->getRecords();
        }
}