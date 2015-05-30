<?php

namespace ModelModule\Model\Users\Settori;

use ModelModule\Model\FormData\FormDataAbstract;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  26 March 2015
 */
class UsersSettoriFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getInput('param', 1);

        $recordFromDb = $this->getFormRecord(isset($param['route']['option']) ? $param['route']['option'] : null);
        $this->setRecord($recordFromDb);

        $usersRecords = $this->getUsersRecords();

        $form = new UsersSettoriForm();
        $form->addResponsabile($usersRecords);

        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);
            $submitButtonValue = 'Modifica';
            $formTitle         = 'Modifica settore utente';
            $formAction        = 'users-settori/update/';
        } else {
            $formTitle          = 'Nuovo settore utente';
            $submitButtonValue  = 'Inserisci';
            $formAction         = 'users-settori/insert/';
        }

        $this->setVariables( array(
                'formTitle'              => $formTitle,
                'formDescription'        => 'Compila i dati relativi al settore utenti',
                'form'                   => $form,
                'formAction'             => $formAction,
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => 'Settori utenti',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/users-settori/',
            )
        );
    }

    /**
     * @param int $id
     * @return array|null
     */
    private function getFormRecord($id)
    {
        if (is_numeric($id)) {
            $wrapper = new UsersSettoriGetterWrapper( new UsersSettoriGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }
    }

    /**
     * @return \Application\Model\QueryBuilderHelperAbstract
     * @throws \Application\Model\NullException
     */
    private function getUsersRecords()
    {
        $wrapper = new UsersGetterWrapper( new UsersGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput( array(
                'adminAccess' => 1,
            )
        );
        $wrapper->setupQueryBuilder();

        $records = $wrapper->getRecords();

        $toReturn = array();
        foreach($records as $record) {
            $toReturn[$record['id']] = $record['surname'].' '.$record['name'];
        }

        return $toReturn;
    }
}