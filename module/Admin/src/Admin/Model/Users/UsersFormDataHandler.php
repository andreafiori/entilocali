<?php

namespace Admin\Model\Users;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Users\UsersForm;

/**
 * @author Andrea Fiori
 * @since  15 June 2013
 */
class UsersFormDataHandler  extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        $idUser = $param['route']['id'];
        
        $form = new UsersForm();
        
        if ( is_numeric($idUser) ) {
            $usersGetterWrapper = new UsersGetterWrapper( new UsersGetter($this->getInput('entityManager',1)) );
            $usersGetterWrapper->setInput( array("id" => $idUser) );
            $usersGetterWrapper->setupQueryBuilder();
            
            $records = $usersGetterWrapper->getRecords();
            $this->setRecord($records);
            
            if ( is_array($records) ) {
                $form->setData($records[0]);
            }
        }
                
        $this->setVariable('form', $form);
        $this->setVariable('formTitle', 'Nuovo utente');
        $this->setVariable('formDescription', 'Creazione nuovo utente');
        
        $this->setVariable('formBreadCrumbCategory', 'Utenti');
    }

    /**
     * @return string
     */
    public function getFormAction($id = null)
    {       
        return 'users/insert/';
    }
}