<?php

namespace Admin\Model\Contenuti;

use Admin\Model\FormData\CrudHandlerAbstract;
use Admin\Model\FormData\CrudHandlerInsertUpdateInterface;
use Admin\Model\FormData\CrudHandlerInterface;
use Application\Model\Database\DbTableContainer;
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
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        $error = array();

        $fields = array('titolo', 'testo', 'dataInserimento', 'dataScadenza', 'attivo');
        foreach($fields as $field) {
            if ( !isset($formData->$field) ) {
                $error[] = 'Campo '.$field.' vuoto';
            }
        }

        return $error;
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
            /* 'evidenza'         => isset($formData->evidenza) ? $formData->evidenza : 0, */
            'utente_id'        => $userDetails->id,
            'rss'              => $formData->rss,
            /*
            $formData->faceobook
            'slug'             => $this->rawPost['titolo'],
            'seo_title'        => $this->rawPost['seoTitle'],
            'seo_description'  => $this->rawPost['seoDescription'],
            'seo_keywords'     => $this->rawPost['seo_keywords'],
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

        return $this->getConnection()->update(
                    DbTableContainer::contenuti,
                    array(
                        'sottosezione_id'   => $formData->sottosezione,
                        'titolo'            => $formData->titolo,
                        'sommario'          => $formData->sommario,
                        'testo'             => $formData->testo,
                        'data_inserimento'  => $formData->dataInserimento,
                        'data_scadenza'     => $formData->dataScadenza,
                        'attivo'            => $formData->attivo,
                        'home'              => $formData->homepage,
                        'rss'               => $formData->rss,
                    ),
                    array('id' => $formData->id)
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
            'module_id' => 2,
            'message'   => $userDetails->name.' '.$userDetails->surname."', ha inserito il contenuto ".$inputFilter->titolo,
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
            'module_id' => 2,
            'message'   => $userDetails->name.' '.$userDetails->surname."', errore nell'inserimento del contenuto ".$inputFilter->titolo.' '.$inputFilter->email.' Messaggio: '.$message,
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
            'module_id' => 2,
            'message'   => $userDetails->name.' '.$userDetails->surname."', ha aggiornato il contenuto ".$inputFilter->titolo,
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
            'module_id' => 2,
            'message'   => $userDetails->name.' '.$userDetails->surname."', errore nell'aggiornamento del contenuto ".$inputFilter->titolo.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}
