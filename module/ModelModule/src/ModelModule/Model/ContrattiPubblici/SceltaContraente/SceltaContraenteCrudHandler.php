<?php

namespace ModelModule\Model\ContrattiPubblici\SceltaContraente;

use ModelModule\Model\FormData\CrudHandlerAbstract;
use ModelModule\Model\FormData\CrudHandlerInterface;
use ModelModule\Model\FormData\CrudHandlerInsertUpdateInterface;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class SceltaContraenteCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    private $tableName;

    protected $validInputFilterObject;

    public function __construct()
    {
        $this->tableName = DbTableContainer::contrattiSceltaContraente;

        $this->form = new SceltaContraenteForm();

        $this->formInputFilter = new SceltaContraenteFormInputFilter();
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        $error = array();

        $fields = array('nomeScelta', 'attivo');
        foreach($fields as $field) {
            if ( !isset($formData->$field) ) {
                $error[] = 'Campo '.$field.' vuoto';
            }
        }

        return $error;
    }

    /**
     * @param SceltaContraenteFormInputFilter $formData
     *
     * @return bool
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->insert($this->tableName, array(
            'nome_scelta'   => $formData->nomeScelta,
            'attivo'        => $formData->attivo,
        ));
    }

    /**
     * @param SceltaContraenteFormInputFilter $formData
     * @return int
     * @throws \Application\Model\NullException
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update($this->tableName, array(
                'nome_scelta'   => $formData->nomeScelta,
                'attivo'        => $formData->attivo,
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

        return $this->getConnection()->delete($this->tableName,
            array('id' => $id),
            array('limit' => 1)
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
            'message'   => "Inserita nuova voce scelta contraente ".$inputFilter->nomeScelta,
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
            'message'   => "Errore nell'inserimento voce scelta contraente ".$inputFilter->nomeScelta.' Messaggio: '.$message,
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
            'message'   => "Aggiornata voce scelta contraente ".$inputFilter->nomeScelta,
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
            'message'   => "Errore nell'aggiornamento della voce scelta conctraente ".$inputFilter->nomeScelta.' Messaggio: '.$message,
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
            'message'   => "Eliminata voce scelta contraente ".$record->nomeScelta,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}
