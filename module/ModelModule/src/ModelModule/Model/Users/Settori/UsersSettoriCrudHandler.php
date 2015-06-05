<?php

namespace ModelModule\Model\Users\Settori;

use ModelModule\Model\FormData\CrudHandlerAbstract;
use ModelModule\Model\FormData\CrudHandlerInsertUpdateInterface;
use ModelModule\Model\FormData\CrudHandlerInterface;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class UsersSettoriCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    private $dbTable;

    private $moduleId;

    public function __construct()
    {
        $this->form = new UsersSettoriForm();

        $this->formInputFilter = new UsersSettoriFormInputFilter();

        $this->dbTable = DbTableContainer::usersSettori;

        $this->moduleId = ModulesContainer::contenuti_id;
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        return $this->checkValidateFormDataError(
            $formData,
            array('nome', 'responsabileUserId')
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {

    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            $this->dbTable,
            array(
                'nome' => $formData->nome,
                'responsabile_user_id' => $formData->responsabileUserId,
            ),
            array('id'    => $formData->id),
            array('limit' => 1)
        );
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        return $this->getConnection()->delete(
            $this->dbTable,
            array('id'    => $id),
            array('limit' => 1)
        );
    }

    /**
     * @return bool
     *
     * @throws \ModelModule\Model\NullException
     */
    public function logInsertOk()
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Inserito il settore utente ".$inputFilter->nome,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @param null $message
     *
     * @return bool
     */
    public function logInsertKo($message = null)
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Errore nell'inserimento settore utente ".$inputFilter->nome.'Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}