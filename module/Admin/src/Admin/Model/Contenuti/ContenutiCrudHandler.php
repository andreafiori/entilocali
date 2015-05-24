<?php

namespace Admin\Model\Contenuti;

use Admin\Model\FormData\CrudHandlerAbstract;
use Admin\Model\FormData\CrudHandlerInsertUpdateInterface;
use Admin\Model\FormData\CrudHandlerInterface;
use Application\Model\Database\DbTableContainer;
use Application\Model\Slugifier;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * @author Andrea Fiori
 * @since  15 February 2015
 */
class ContenutiCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    public function __construct()
    {
        $this->form = new ContenutiForm();

        $this->formInputFilter = new ContenutiFormInputFilter();
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
            array('titolo', 'testo', 'dataInserimento', 'dataScadenza', 'attivo')
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

        if (isset($formData->faceobook)) {

        }

        return $this->getConnection()->insert(DbTableContainer::contenuti, array(
            'titolo'           => $formData->titolo,
            'anno'             => date("Y"),
            'numero'           => 0,
            'sommario'         => $formData->sommario,
            'testo'            => $formData->testo,
            'data_inserimento' => $formData->dataInserimento,
            'data_scadenza'    => $formData->dataScadenza,
            'attivo'           => $formData->attivo,
            'sottosezione_id'  => $formData->sottosezione,
            'home'             => isset($formData->home) ? $formData->home : 0,
            'utente_id'        => $userDetails->id,
            'rss'              => $formData->rss,
            'slug'             => Slugifier::slugify($formData->titolo),
            /*
            'evidenza'         => isset($formData->evidenza) ? $formData->evidenza : 0,
            'seo_title'        => $formData->seoTitle,
            'seo_description'  => $formData->seoDescription,
            'seo_keywords'     => $formData->seo_keywords,
            */
        ));
    }

    /**
     * @param ContenutiFormInputFilter $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->asssertConnection();

        $arrayUpdate = array(
            'sottosezione_id'   => $formData->sottosezione,
            'titolo'            => $formData->titolo,
            'sommario'          => $formData->sommario,
            'testo'             => $formData->testo,
            'data_inserimento'  => $formData->dataInserimento,
            'data_scadenza'     => $formData->dataScadenza,
            'attivo'            => $formData->attivo,
            'home'              => $formData->homepage,
            'rss'               => $formData->rss,
        );

        if ($formData->utente) {
            $arrayUpdate['utente_id'] = $formData->utente;
        }

        return $this->getConnection()->update(
                    DbTableContainer::contenuti,
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
            DbTableContainer::contenuti,
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
            'message'   => "Inserito il contenuto ".$inputFilter->titolo,
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
            'message'   => "Errore nell'inserimento del contenuto ".$inputFilter->titolo.' Messaggio: '.$message,
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
            'message'   => "Aggiornato il contenuto ".$inputFilter->titolo,
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
            'message'   => "Errore nell'aggiornamento del contenuto ".$inputFilter->titolo.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}
