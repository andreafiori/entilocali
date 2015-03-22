<?php

namespace Admin\Model\Sezioni;

use Admin\Model\FormData\CrudHandlerAbstract;
use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerInsertUpdateInterface;
use Application\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Application\Model\Slugifier;

/**
 * @author Andrea Fiori
 * @since  17 February 2014
 */
class SezioniCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    protected $validInputFilterObject;

    /**
     * Setup form and its input filter
     */
    public function __construct()
    {
        $this->form = new SezioniForm();

        $this->formInputFilter = new SezioniFormInputFilter();
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        $error = array();

        $fields = array('nome', 'colonna', 'posizione', 'attivo');
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

        return $this->getConnection()->insert(DbTableContainer::sezioni, array(
            'nome'             => $formData->nome,
            'colonna'          => $formData->colonna,
            'posizione'        => $formData->posizione,
            'lingua'           => $formData->lingua,
            'blocco'           => $formData->blocco,
            'modulo_id'        => isset($formData->modulo) ? $formData->modulo : 2,
            'attivo'           => $formData->attivo,
            'url'              => $formData->url,
            'slug'             => Slugifier::slugify($formData->nome),
            /*
            'link_macro'       => $formData->link_macro,
            'css_id'           => $formData->css_id,
            'image'            => $formData->image,
            'seo_title'        => $formData->seoTitle,
            'seo_description'  => $formData->seoDescription,
            'seo_keywords'     => $formData->seoKeywords,
            */
            'insert_date' => date("Y-m-d H:i:s"),
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

        /*
        $this->setArrayRecordToHandle('nome', 'nome');
        $this->setArrayRecordToHandle('colonna', 'colonna');
        $this->setArrayRecordToHandle('posizione', 'posizione');
        $this->setArrayRecordToHandle('link_macro', 'link_macro');
        $this->setArrayRecordToHandle('lingua', 'lingua');
        $this->setArrayRecordToHandle('blocco', 'blocco');
        $this->setArrayRecordToHandle('modulo_id', 'modulo');
        $this->setArrayRecordToHandle('attivo', 'attivo');
        $this->setArrayRecordToHandle('url', 'url');
        $this->setArrayRecordToHandle('css_id', 'cssId');
        $this->setArrayRecordToHandle('image', 'image');
        $this->setArrayRecordToHandle('slug', 'slug');
        $this->setArrayRecordToHandle('seo_title', 'seoTitle');
        $this->setArrayRecordToHandle('seo_description', 'seoDescription');
        $this->setArrayRecordToHandle('seo_keywords', 'seoKeywords');
        */

        return $this->getConnection()->update(
            DbTableContainer::entiTerzi,
            array(
                'nome'        => $formData->nome,
                'colonna'     => $formData->colonna,
                'last_update' => date("Y-m-d H:i:s"),
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
            DbTableContainer::entiTerzi,
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
            'message'   => $userDetails->name.' '.$userDetails->surname."' ha aggiornato l'ente terzo ".$inputFilter->nome,
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
            'message'   => $userDetails->name.' '.$userDetails->surname."', errore durante l'inserimento della sezione ".$inputFilter->nome.' Messaggio: '.$message,
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
            'message'   => $userDetails->name.' '.$userDetails->surname."', ha aggiornato il ente terzo ".$inputFilter->nome,
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
            'message'   => $userDetails->name.' '.$userDetails->surname."', errore nell'aggiornamento dell'ente terzo ".$inputFilter->nome.' Messaggio: '.$message,
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
            'message'   => $userDetails->name.' '.$userDetails->surname."', ha eliminato l'ente terzo ".$record->nome,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}