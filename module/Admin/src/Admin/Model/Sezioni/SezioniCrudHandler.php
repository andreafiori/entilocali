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
class SezioniCrudHandler extends CrudHandlerAbstract
{
    private $dbTable;

    /**
     * Setup form and its input filter
     */
    public function __construct()
    {
        $this->form = new SezioniForm();
        $this->form->addLingue(array());
        $this->form->addOptions();

        $this->formInputFilter = new SezioniFormInputFilter();

        $this->dbTable = DbTableContainer::sezioni;
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
            array('nome', 'colonna', 'attivo')
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

        return $this->getConnection()->insert($this->dbTable, array(
            'nome'             => $formData->nome,
            'colonna'          => $formData->colonna,
            'posizione'        => $formData->posizione,
            'lingua'           => $formData->lingua,
            'blocco'           => $formData->blocco,
            'modulo_id'        => isset($formData->modulo) ? $formData->modulo : 2,
            'attivo'           => $formData->attivo,
            'url'              => $formData->url,
            'slug'             => Slugifier::slugify($formData->nome),
            'utente_id'        => $userDetails->id,
            /*
            'link_macro'       => $formData->link_macro,
            'css_id'           => $formData->css_id,
            'image'            => $formData->image,
            'seo_title'        => $formData->seoTitle,
            'seo_description'  => $formData->seoDescription,
            'seo_keywords'     => $formData->seoKeywords,
            'is_amm_trasparente'     => $formData->seoKeywords,
            'show_to_all'     => $formData->show_to_all,
            */
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
            $this->dbTable,
            array(
                'nome'        => $formData->nome,
                'colonna'     => $formData->colonna,
                'lingua'      => $formData->lingua,
                'attivo'      => $formData->attivo,
                'url'         => $formData->url,
                'slug'        => Slugifier::slugify($formData->nome),
            ),
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
        $this->asssertConnection();

        return $this->getConnection()->delete(
            $this->dbTable,
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
            'module_id' => '2',
            'message'   => $userDetails->name.' '.$userDetails->surname."' ha aggiornato la sezione ".$inputFilter->nome,
            'type'      => 'info',
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
            'module_id' => '2',
            'message'   => "Errore durante l'inserimento della sezione ".$inputFilter->nome.' Messaggio: '.$message,
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
            'message'   => "Aggiornato la sezione ".$inputFilter->nome,
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
            'message'   => "Errore nell'aggiornamento della sezione ".$inputFilter->nome.' Messaggio: '.$message,
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