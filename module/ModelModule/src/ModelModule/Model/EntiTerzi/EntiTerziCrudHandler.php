<?php

namespace ModelModule\Model\EntiTerzi;

use ModelModule\Model\FormData\CrudHandlerAbstract;
use ModelModule\Model\FormData\CrudHandlerInterface;
use ModelModule\Model\FormData\CrudHandlerInsertUpdateInterface;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  19 March 2015
 */
class EntiTerziCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    protected $validInputFilterObject;

    public function __construct()
    {
        $this->form = new EntiTerziForm();

        $this->formInputFilter = new EntiTerziFormInputFilter();
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        $error = array();

        $fields = array('nome','email');
        foreach($fields as $field) {
            if ( !isset($formData->$field) ) {
                $error[] = 'Campo '.$field.' vuoto';
            }
        }

        return $error;
    }

    /**
     * @param EntiTerziFormInputFilter $formData
     *
     * @return bool
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(DbTableContainer::entiTerzi, array(
            'nome'        => $formData->nome,
            'email'       => $formData->email,
            'insert_date' => date("Y-m-d H:i:s"),
            'last_update' => date("Y-m-d H:i:s"),
        ));
    }

    /**
     * @param EntiTerziFormInputFilter $formData
     * @return int
     * @throws \Application\Model\NullException
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(DbTableContainer::entiTerzi, array(
                'nome'        => $formData->nome,
                'email'       => $formData->email,
                'last_update' => date("Y-m-d H:i:s"),
            ),
            array('id' => $formData->id)
        );
    }

    /**
     * @param $id
     * @return int
     * @throws \Application\Model\NullException
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    public function delete($id)
    {
        $this->assertConnection();

        return $this->getConnection()->delete(DbTableContainer::entiTerzi,
            array('id' => $id),
            array('limit' )
        );
    }

    /**
     * @return bool
     * @throws \Application\Model\NullException
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
            'module_id' => 2,
            'message'   => "Inserito l'ente terzo ".$inputFilter->nome,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @param null $message
     * @return bool
     * @throws \Application\Model\NullException
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
            'module_id' => 2,
            'message'   => "Errore nell'inserimento dell'ente terzo ".$inputFilter->nome.' '.$inputFilter->email.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @return bool
     *
     * @throws \Application\Model\NullException
     */
    public function logUpdateOk()
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Ha aggiornato il ente terzo ".$inputFilter->nome,
            'type'      => 'info',
            'backend'   => 1,
        ));
    }

    /**
     * @param null $message
     * @return bool
     * @throws \Application\Model\NullException
     */
    public function logUpdateKo($message = null)
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Errore nell'aggiornamento dell'ente terzo ".$inputFilter->nome.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @param array $record
     *
     * @return bool
     */
    public function logDelete(array $record)
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $LogWriter = $this->getLogWriter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Eliminato l'ente terzo ".$record->nome,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}