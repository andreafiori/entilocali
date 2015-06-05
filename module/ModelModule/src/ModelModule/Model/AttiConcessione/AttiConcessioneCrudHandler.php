<?php

namespace ModelModule\Model\AttiConcessione;

use ModelModule\Model\FormData\CrudHandlerAbstract;
use ModelModule\Model\FormData\CrudHandlerInsertUpdateInterface;
use ModelModule\Model\FormData\CrudHandlerInterface;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  16 December 2014
 */
class AttiConcessioneCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    private $dbTable;

    private $moduleId;

    public function __construct()
    {
        $this->form = new AttiConcessioneForm();

        $this->formInputFilter = new AttiConcessioneFormInputFilter();

        $this->dbTable = DbTableContainer::attiConcessione;

        $this->moduleId = ModulesContainer::atti_concessione;
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        $error = $this->checkValidateFormDataError(
            $formData,
            array('titolo', 'beneficiario', 'ufficioResponsabile', 'importo', 'modAssegnazione', 'dataInserimento', 'anno')
        );

        if ( (int)$formData->anno > 2030 or (int)$formData->anno < 1954 ) {
            $error[] = 'Anno atto deve essere un anno valido.';
        }

        return $error;
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $this->assertUserDetails();

        $userDetails = $this->getUserDetails();

        return $this->getConnection()->insert($this->dbTable, array(
            'titolo'                => $formData->titolo,
            'beneficiario'          => $formData->beneficiario,
            'importo'               => $formData->importo,
            'mod_assegnazione_id'   => $formData->modAssegnazione,
            'data'                  => $formData->dataInserimento,
            'anno'                  => $formData->anno,
            'settore_id'            => $formData->ufficioResponsabile,
            'resp_proc_id'          => $formData->respProc,
            'utente_id'             => $userDetails->id,
        ));
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $this->assertUserDetails();

        $userDetails = $this->getUserDetails();

        $arrayToUpdate = array(
            'titolo'                => $formData->titolo,
            'beneficiario'          => $formData->beneficiario,
            'importo'               => $formData->importo,
            'mod_assegnazione_id'   => $formData->modAssegnazione,
            'data'                  => $formData->dataInserimento,
            'anno'                  => $formData->anno,
            'settore_id'            => $formData->ufficioResponsabile,
            'resp_proc_id'          => $formData->respProc,
        );

        if (isset($formData->utente)) {
            $arrayToUpdate['utente_id'] = $formData->utente;
        }

        return $this->getConnection()->update(
            $this->dbTable,
            $arrayToUpdate,
            array('id'    => $formData->id),
            array('limit' => 1)
        );
    }

    /**
     * TODO: delete attachments
     *
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
            'module_id' => $this->moduleId,
            'message'   => "Inserito nuovo atto concessione ".$inputFilter->titolo,
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
            'message'   => "Errore nell'inserimento atto concessione ".$inputFilter->titolo.' Messaggio: '.$message,
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

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Aggiornato atto concessione ".$inputFilter->titolo,
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

        $LogWriter = $this->getLogWriter();

        $inputFilter = $this->getFormInputFilter();

        return $LogWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => $this->moduleId,
            'message'   => "Errore nell'aggiornamento dell'atto concessione ".$inputFilter->titolo.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}
