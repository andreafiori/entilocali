<?php

namespace ModelModule\Model\FormData;

use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use ModelModule\Model\Log\LogWriter;

/**
 * @author Andrea Fiori
 * @since  01 June 2014
 */
abstract class CrudHandlerAbstract
{
    /**
     * @var \Zend\Form\Form
     */
    protected $form;

    /**
     * @var InputFilterAwareInterface
     */
    protected $formInputFilter;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;

    /**
     * @var \Zend\Mvc\Controller\Plugin\Url
     */
    protected $url;

    /**
     * @var array
     */
    protected $configurationsFromDb;

    protected $userDetails;

    protected $logMethodToExecute;

    protected $LogWriter;

    protected $recordsToHandle = array();

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return \Doctrine\ORM\EntityManager
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this->entityManager;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

        /**
         * @throws NullException
         */
        protected function assertEntityManager()
        {
            if (!$this->getEntityManager()) {
                throw new NullException("Doctrine Entity Manager instance is not set");
            }
        }

    /**
     * @param \Doctrine\DBAL\Connection $connection
     * @return \Doctrine\DBAL\Connection
     */
    public function setConnection(\Doctrine\DBAL\Connection $connection)
    {
        $this->connection = $connection;

        return $this->connection;
    }

    /**
     * @throws NullException
     */
    protected function assertConnection()
    {
        if (!$this->getConnection()) {
            throw new NullException("Doctrine connection instance is not set");
        }
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param array $configurationsFromDb
     */
    public function setConfigurationsFromDb($configurationsFromDb)
    {
        $this->configurationsFromDb = $configurationsFromDb;
    }

    /**
     * @return array
     */
    public function getConfigurationsFromDb()
    {
        return $this->configurationsFromDb;
    }

        /**
         * @throws NullException
         */
        protected function asssertConfigurationsFromDb()
        {
            if (!$this->getConfigurationsFromDb()) {
                throw new NullException("Configurations array from database is not set");
            }
        }

    /**
     * @param $key
     * @param $value
     * @param InputFilterAwareInterface $formInputFilter
     * @return mixed
     */
    protected function setupRecordElementToHandle($key, $value, InputFilterAwareInterface $formInputFilter)
    {
        if ( isset($this->$formInputFilter->$key) ) {
            $this->recordsToHandle = $value;
        }

        return $this->arrayRecordToHandle;
    }

    /**
     * @param array $recordsToHandle
     * @param InputFilterAwareInterface $formInputFilter
     * @return array
     */
    protected function setupRecordsToHandle(array $recordsToHandle, InputFilterAwareInterface $formInputFilter)
    {
        foreach($recordsToHandle as $record) {
            $this->setupRecordElementToHandle($record[0], $record[1], $formInputFilter);
        }

        return $this->recordsToHandle;
    }

    protected function cleanArrayRecordToHandle()
    {
        $this->recordsToHandle = array();
    }

    /**
     * @param $errorMessage
     * @param string $title
     * @param string $type
     * @return array
     */
    public function setupErrorMessage($errorMessage, $title = 'Errori verificati', $type = 'danger')
    {
        $message = array(
            'messageType'           => $type,
            'messageTitle'          => $title,
        );

        if (is_array($errorMessage)) {
            $message['messageText'] = 'Si sono verificati i seguenti errori:';
            $message['messageList'] = $errorMessage;
        } else {
            $message['messageText'] = $errorMessage;
        }

        return $message;
    }

    /**
     * @param string $title
     * @param string $message
     * @param string $type
     * @return array|string
     */
    public function setupSuccessMessage(
        $title = 'Operazione effettuata con successo',
        $message = 'I dati sono stati elaborati correttamente',
        $type = 'success')
    {

        $message = array(
            'messageType'           => $type,
            'messageTitle'          => $title,
            'messageText'           => $message,
        );

        return $message;
    }

    /**
     * @param mixed $userDetails
     */
    public function setUserDetails($userDetails)
    {
        $this->userDetails = $userDetails;
    }

    /**
     * @return mixed
     */
    public function getUserDetails()
    {
        return $this->userDetails;
    }

    /**
     * @throws NullException
     */
    protected function assertUserDetails()
    {
        if ( !$this->getUserDetails() ) {
            throw new NullException("User details are not set");
        }
    }

    /**
     * @param $operation
     * @param $ok
     * @return string
     * @throws NullException
     */
    public function setupLogMethodToExecute($operation, $ok)
    {
        if ($operation == 'insert') {

            $this->logMethodToExecute = ($ok) ? 'logInsertOk' : 'logInsertKo';

        } elseif ($operation == 'update') {

            $this->logMethodToExecute = ($ok) ? 'logUpdateOk' : 'logUpdateKo';

        } elseif ($operation == 'delete') {

            $this->logMethodToExecute = ($ok) ? 'logDeleteOk' : 'logDeleteKo';

        } else {
            throw new NullException("Operation not allowed");
        }

        return $this->logMethodToExecute;
    }

    public function log()
    {
        $logMethod = $this->logMethodToExecute;

        if (!$logMethod) {
            throw new NullException('Log method to execute is not set');
        }

        if (method_exists(get_called_class(), $logMethod)) {
            return $this->$logMethod();
        }

        throw new NullException($logMethod.' does not exist on '.get_called_class());
    }

    /**
     * @param $form
     * @return \Zend\Form\Form
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this->form;
    }

    /**
     * @return \Zend\Form\Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return InputFilterAwareInterface
     */
    public function getFormInputFilter()
    {
        return $this->formInputFilter;
    }

    /**
     * @return string
     */
    public function getLogMethodToExecute()
    {
        return $this->logMethodToExecute;
    }

    /**
     * @param $operation
     * @param $ok
     * @return array
     */
    public function setupVariablesForTheView($operation, $ok)
    {
        if ($operation=='insert') {
            if ($ok) {
                return array(
                    'messageShowFormLink'        => 0,
                    'showLinkResetFormAndShowIt' => 1,
                );
            } else {
                return array(
                    'messageShowFormLink' => 1,
                );
            }
        } elseif($operation=='update') {
            if ($ok) {
                return array(
                    'messageShowFormLink' => 1,
                    'showLinkResetFormAndShowIt' => 0,
                );
            } else {
                return array(
                    'messageShowFormLink' => 1,
                    'showLinkResetFormAndShowIt' => 0,
                );
            }
        }

        return array();
    }

    public function addVariablesForTheView(InputFilterAwareInterface $formData, $operation)
    {
        return array();
    }

    /**
     * @return LogWriter
     */
    public function getLogWriter()
    {
        return $this->LogWriter;
    }

    /**
     * @param LogWriter $LogWriter
     * @return LogWriter
     */
    public function setLogWriter(LogWriter $LogWriter)
    {
        $this->LogWriter = $LogWriter;

        return $this->LogWriter;
    }

    /**
     * @throws NullException
     */
    protected function assertLogWriter()
    {
        if (!$this->getLogWriter()) {
            throw new NullException('Log writer is not set');
        }
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return array
     */
    protected function checkValidateFormDataError(InputFilterAwareInterface $formData, $arrayFields)
    {
        $error = array();

        foreach($arrayFields as $field) {
            if ( !isset($formData->$field) ) {
                $error[] = 'Campo '.$field.' vuoto';
            }
        }

        return $error;
    }

    /**
     * @return \Zend\Mvc\Controller\Plugin\Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param \Zend\Mvc\Controller\Plugin\Url $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
