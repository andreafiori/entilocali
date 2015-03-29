<?php

namespace Admin\Model\Sezioni;

use Zend\InputFilter\InputFilterAwareInterface;
use Admin\Model\FormData\CrudHandlerAbstract;
use Application\Model\Database\DbTableContainer;
use Application\Model\Slugifier;

/**
 * @author Andrea Fiori
 * @since  17 February 2014
 */
class SottoSezioniCrudHandler extends CrudHandlerAbstract
{
    /**
     * Setup form and its input filter
     */
    public function __construct()
    {
        $this->form = new SottoSezioniForm();
        $this->form->addSezioni(array(
            1 => 'Giunta',
            2 => 'Sindaco',
            3 => 'Dove siamo',
        ));
        $this->form->addMainFormInputs();

        $this->formInputFilter = new SottoSezioniFormInputFilter();
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
            array('nomeSottoSezione', 'sezione', 'attivo')
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     * @throws \Application\Model\NullException
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->asssertConnection();

        $this->assertUserDetails();

        $userDetails = $this->getUserDetails();

        return $this->getConnection()->insert(DbTableContainer::sottosezioni, array(
            'nome'              => $formData->nomeSottoSezione,
            'sezione_id'        => $formData->sezione,
            'url'               => $formData->url,
            'url_title'         => $formData->urlTitle,
            'posizione'         => $formData->posizione,
            'attivo'            => $formData->attivo,
            'profondita_da'     => 0,
            'profondita_a'      => '',
            'slug'              => Slugifier::slugify($formData->nomeSottoSezione),
            'utente_id'         => $userDetails->id,
        ));
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     * @throws \Application\Model\NullException
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->asssertConnection();

        return $this->getConnection()->update(
            DbTableContainer::sottosezioni,
            array(
                'nome'          => $formData->nomeSottoSezione,
                'attivo'        => $formData->attivo,
                'sezione_id'    => $formData->sezione,
                'url'           => $formData->url,
                'url_title'     => $formData->urlTitle,
            ),
            array('id' => $formData->idSottoSezione),
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
        $this->asssertConnection();

        return $this->getConnection()->delete(
            DbTableContainer::sottosezioni,
            array('id'    => $id),
            array('limit' => 1)
        );
    }

    /**
     * @return bool
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
            'module_id' => 2,
            'message'   => "Inserita la sotto-sezione ".$inputFilter->nomeSottoSezione.' Messaggio: ',
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

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Errore durante l'inserimento della sotto-sezione ".$inputFilter->nomeSottoSezione.' Messaggio: '.$message,
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

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Aggiornato la sezione ".$inputFilter->nomeSottoSezione,
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

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Errore nell'aggiornamento della sezione ".$inputFilter->nomeSottoSezione.' Messaggio: '.$message,
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

        $logsWriter = $this->getLogsWriter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Eliminata la sezione ".$record->nome,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}
