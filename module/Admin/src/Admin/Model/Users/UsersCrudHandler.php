<?php

namespace Admin\Model\Users;

use Admin\Model\FormData\CrudHandlerAbstract;
use Admin\Model\FormData\CrudHandlerInsertUpdateInterface;
use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\Modules\ModulesContainer;
use Application\Model\Database\DbTableContainer;
use Application\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  30 March 2015
 */
class UsersCrudHandler  extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    private $dbTable;

    private $moduleId;

    public function __construct()
    {
        $this->form = new UsersForm();

        $this->formInputFilter = new UsersFormInputFilter();

        $this->dbTable = DbTableContainer::users;

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
            array('name', 'surname', 'username', 'email', 'roleId')
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->asssertConnection();

        $arrayInsert = array(
            'name'          => $formData->name,
            'surname'       => $formData->surname,
            'email'         => $formData->email,
            'username'      => $formData->username,
            'role_id'       => $formData->roleId,
            'last_update'   => date("Y-m-d H:i:s"),
            'create_date'   => date("Y-m-d H:i:s"),
        );

        if (empty($formData->password)) {
            throw new NullException("Inserire la password");
        }

        if (!empty($formData->password) and $formData->password==$formData->password_verify) {
            $arrayInsert['password'] = md5($formData->password);
        }

        if ($formData->password != '' and $formData->password != $formData->password_verify) {
            throw new NullException('Le due password non coincidono');
        }

        return $this->getConnection()->insert($this->dbTable, $arrayInsert);
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->asssertConnection();

        $arrayToUpdate = array(
            'name'          => $formData->name,
            'surname'       => $formData->surname,
            'email'         => $formData->email,
            'username'      => $formData->username,
            'role_id'       => $formData->roleId,
            'last_update'   => date("Y-m-d H:i:s"),
        );

        if (!empty($formData->settoreId)) {
            $arrayToUpdate['settore_id'] = $formData->settoreId;
        }

        if ($formData->password != '' and $formData->password != $formData->password_verify) {
            throw new NullException('Le due password non coincidono');
        }

        if ($formData->password != '' and $formData->password_verify != '' and $formData->password == $formData->password_verify) {
            $salt = uniqid();
            $arrayToUpdate['password']                  = md5($formData->password.$salt);
            $arrayToUpdate['salt']                      = $salt;
            $arrayToUpdate['password_last_update']      = date("Y-m-d H:i:s");
        }

        return $this->getConnection()->update(
            $this->dbTable,
            $arrayToUpdate,
            array('id' => $formData->id),
            array('limit' => 1)
        );
    }

    /**
     * @param $id
     *
     * @return int
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
     * @throws \Application\Model\NullException
     */
    public function logInsertOk()
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Inserito nuovo utente ".$inputFilter->name.' '.$inputFilter->surname,
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

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Errore nell'inserimento utente ".$inputFilter->name.' '.$inputFilter->surname.'Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @return bool
     */
    public function logUpdateOk()
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Aggiornato utente ".$inputFilter->name.' '.$inputFilter->surname,
            'type'      => 'info',
            'backend'   => 1,
        ));
    }

    /**
     * @param null $message
     *
     * @return bool
     */
    public function logUpdateKo($message = null)
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Errore nell'aggiornamento utente ".$inputFilter->name.' '.$inputFilter->surname.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

}
