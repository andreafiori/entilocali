<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\FormData\CrudHandlerAbstract;
use ModelModule\Model\FormData\CrudHandlerInsertUpdateInterface;
use ModelModule\Model\FormData\CrudHandlerInterface;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  23 October 2014
 */
class AlboPretorioArticoliCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    private $dbTable;

    public function __construct()
    {
        $this->form = new AlboPretorioArticoliForm();

        $this->formInputFilter = new AlboPretorioArticoliFormInputFilter();

        $this->dbTable = DbTableContainer::alboArticoli;
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        $error = $this->checkValidateFormDataError(
            $formData,
            array('userId', 'sezione', 'dataScadenza', 'titolo')
        );

        return $error;
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
            'utente_id'             => $userDetails->id,
            'sezione_id'            => $formData->sezione,
            'numero_progressivo'    => $formData->numeroProgressivo,
            'numero_atto'           => $formData->numeroAtto,
            'anno'                  => $formData->anno,
            'data_attivazione'      => date("Y-m-d H:i:s"),
            'ora_attivazione'       => date("H:i:s"),
            'data_pubblicare'       => date("Y-m-d H:i:s"),
            'ora_pubblicare'        => date("H:i:s"),
            'data_scadenza'         => $formData->dataScadenza,
            'data_pubblicare'       => date("Y-m-d H:i:s"),
            'titolo'                => $formData->titolo,
            'pubblicare'            => 0,
            'annullato'             => 0,
            'check_invia_regione'   => isset($formData->checkInviaRegione) ? $formData->checkInviaRegione : 0,
            'anno_atto'             => date("Y"),
            'ente_terzo'            => $formData->enteTerzo,
            'fonte_url'             => $formData->fonteUrl,
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

        $this->assertUserDetails();

        $userDetails = $this->getUserDetails();

        $arrayUpdate = array(
            'utente_id'             => $userDetails->id,
            'sezione_id'            => $formData->sezione,
            'data_pubblicare'       => date("Y-m-d H:i:s"),
            'ora_pubblicare'        => date("H:i:s"),
            'data_scadenza'         => $formData->dataScadenza,
            'data_pubblicare'       => date("Y-m-d H:i:s"),
            'titolo'                => $formData->titolo,
            'pubblicare'            => 0,
            'annullato'             => 0,
            'check_rettifica'       => isset($formData->checkRettifica) ? $formData->checkRettifica : 0,
            'check_invia_regione'   => isset($formData->checkInviaRegione) ? $formData->checkInviaRegione : 0,
            'anno_atto'             => date("Y"),
            'ente_terzo'            => $formData->enteTerzo,
            'fonte_url'             => $formData->fonteUrl,
            'note'                  => isset($formData->note) ? $formData->note : null,
        );

        if (!empty($formData->numeroAtto)) {
            $arrayUpdate['numero_atto'] = $formData->numeroAtto;
        }

        if (!empty($formData->anno)) {
            $arrayUpdate['anno'] = $formData->anno;
        }

        return $this->getConnection()->update(
            $this->dbTable,
            $arrayUpdate,
            array('id' => $formData->id)
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return array
     */
    public function addVariablesForTheView(InputFilterAwareInterface $formData, $operation)
    {
        if ($operation=='update') {
            return array(
                'messageShowFormLink'   =>  1,
                'attachmentFilesModule' =>  1,
                'attachmentLink'        =>  $this->getUrl()->fromRoute('admin/attachments-form',  array(
                    'lang' => 'it',
                    'module' => 'albo-pretorio',
                    'id' => $formData->id
                ))
            );
        }
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
            'module_id' => 2,
            'message'   => "Inserito un nuovo atto albo pretorio ".$inputFilter->titolo,
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
            'module_id' => 2,
            'message'   => "Errore nell'inserimento atto albo pretorio ".$inputFilter->titolo.'Messaggio: '.$message,
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
            'module_id' => 2,
            'message'   => "Aggiornato l'atto albo pretorio ".$inputFilter->titolo,
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
            'module_id' => 2,
            'message'   => "Errore nell'aggiornamento dell'atto albo pretorio ".$inputFilter->titolo.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}
