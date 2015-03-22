<?php

namespace Admin\Model\FormData;

use Application\Model\NullException;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Admin\Model\Logs\LogsWriter;
use ZendTest\XmlRpc\Server\Exception;

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
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;

    protected $userDetails;

    protected $logMethodToExecute;

    protected $logsWriter;

    protected $recordsToHandle = array();

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
    protected function asssertConnection()
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
                );
            } else {
                return array(
                    'messageShowFormLink' => 1,
                );
            }
        }

        return array();
    }

    /**
     * @return LogsWriter
     */
    public function getLogsWriter()
    {
        return $this->logsWriter;
    }

    /**
     * @param LogsWriter $logsWriter
     * @return LogsWriter
     */
    public function setLogsWriter(LogsWriter $logsWriter)
    {
        $this->logsWriter = $logsWriter;

        return $this->logsWriter;
    }

    /**
     * @throws NullException
     */
    protected function assertLogWriter()
    {
        if (!$this->getLogsWriter()) {
            throw new NullException('Log writer is not set');
        }
    }
}
