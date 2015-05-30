<?php

namespace ModelModule\Model\StatoCivile;

use ModelModule\Model\FormData\CrudHandlerAbstract;
use ModelModule\Model\FormData\CrudHandlerInsertUpdateInterface;
use ModelModule\Model\FormData\CrudHandlerInterface;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  30 October 2014
 */
class StatoCivileCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    private $dbTable;

    private $moduleId;

    public function __construct()
    {
        $this->form = new StatoCivileForm();

        $this->formInputFilter = new StatoCivileFormInputFilter();

        $this->dbTable = DbTableContainer::statoCivileArticoli;

        $this->moduleId = ModulesContainer::stato_civile_id;
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        return $this->checkValidateFormDataError(
            $formData,
            array('titolo', 'sezione', 'attivo', 'scadenza')
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

        $this->assertUserDetails();

        $userDetails = $this->getUserDetails();

        return $this->getConnection()->insert($this->dbTable, array(
            'titolo'                => $formData->titolo,
            'progressivo'           => (isset($formData->numeroProgressivo)) ? $formData->numeroProgressivo : 0,
            'anno'                  => date("Y"),
            'data'                  => date("Y-m-d"),
            'ora'                   => date("H:i:s"),
            'attivo'                => $formData->attivo,
            'scadenza'              => $formData->scadenza,
            'flag_allegati'         => 0,
            'utente_id'             => $userDetails->id,
            'sezione_id'            => $formData->sezione,
        ));
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->asssertConnection();

        $arrayUpdate = array(
            'titolo'                => $formData->titolo,
            'anno'                  => date("Y"),
            'data'                  => date("Y-m-d"),
            'ora'                   => date("H:i:s"),
            'attivo'                => $formData->attivo,
            'scadenza'              => $formData->scadenza,
            'sezione_id'            => $formData->sezione,
        );

        if (isset($formData->utente)) {
            $arrayUpdate['utente_id'] = $formData->utente;
        }

        return $this->getConnection()->update($this->dbTable,
            $arrayUpdate,
            array('id' => $formData->id)
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
            'message'   => $userDetails->name.' '.$userDetails->surname."', ha inserito l'atto stato civile ".$inputFilter->titolo,
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
            'message'   => $userDetails->name.' '.$userDetails->surname."', errore nell'inserimento atto stato civile ".$inputFilter->titolo.'Messaggio: '.$message,
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
            'message'   => $userDetails->name.' '.$userDetails->surname."', ha aggiornato la sezione stato civile ".$inputFilter->titolo,
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
            'message'   => $userDetails->name.' '.$userDetails->surname."', errore nell'aggiornamento dell'atto stato civile ".$inputFilter->titolo.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}