<?php

namespace Admin\Model\FormData;

use Application\Model\NullException;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Admin\Model\Logs\LogsWriter;

/**
 * @author Andrea Fiori
 * @since  01 June 2014
 */
abstract class CrudHandlerAbstract extends RouterManagerAbstract
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;
    
    protected $allowedOperations = array("insert", "update", "delete");
    protected $operation;

    protected $rawPost;
    protected $rawFiles;

    protected $arrayRecordToHandle = array();

    protected $logsWriter;

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->setInput($input);

        $param = $this->getInput('param', 1);

        if (isset($param['post'])) {
            $this->rawPost = $param['post'];
        }

        if (isset($param['files'])) {
            $this->rawFiles = $param['files'];
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
    protected function asssertConnection()
    {
        if ($this->getConnection()) {
            throw new NullException("Doctrine connection instance is not set on this object");
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
     * @param string $operation
     * @return string
     */
    public function setOperation($operation)
    {
        if ( !in_array($operation, $this->allowedOperations) ) {
            throw new \Application\Model\NullException('Operazione non consentita');
        }

        $this->operation = $operation;

        return $this->operation;
    }

    /**
     * @return string
     */
    public function getOperation()
    {
        return $this->operation;
    }

        /**
         * @param string $recordDBField
         * @param string $rawPostKey
         * @param int $notNull
         *
         * @return array|bool
         */
        protected function setArrayRecordToHandle($recordDBField, $rawPostKey, $notNull=0)
        {
            if ($notNull) {
                if ( empty($this->rawPost[$rawPostKey]) ) {
                    return false;
                }
            }

            if ( isset($this->rawPost[$rawPostKey]) ) {
                $this->arrayRecordToHandle[$recordDBField] = $this->rawPost[$rawPostKey];
            }

            return $this->arrayRecordToHandle;
        }

        /**
         * @param string $key
         * @param string $value
         */
        protected function setArrayRecordElement($key, $value)
        {
            $this->arrayRecordToHandle[$key] = $value;
        }

        protected function cleanArrayRecordToHandle()
        {
            $this->arrayRecordToHandle = array();
        }

        /**
         * @return array
         */
        protected function getArrayRecordToHandle()
        {
            if (is_array($this->arrayRecordToHandle)) {
                return $this->arrayRecordToHandle;
            }
            
            return $this->arrayRecordToHandle;
        }

        /**
         * @param string $errorMessage
         * @param string $title
         */
        protected function setErrorMessage($errorMessage, $title = 'Errori verificati', $type = 'danger')
        {
            $this->setVariable('messageType', $type);
            $this->setVariable('messageTitle', $title);
            $this->setVariable('messageShowFormLink', 1);
            
            if (is_array($errorMessage)) {
                $this->setVariable('messageText', 'Si sono verificati i seguenti errori: ');
                $this->setVariable('messageList', $errorMessage);
            } else {
                $this->setVariable('messageText', $errorMessage);
            }
        }

        /**
         * @param string $title
         * @param string $message
         * @param string $type
         */
        protected function setSuccessMessage(
            $title = 'Operazione effettuata con successo',
            $message = 'I dati sono stati elaborati correttamente',
            $type = 'success')
        {
            $this->setVariables(array(
                'messageType'   => $type,
                'messageTitle'  => $title,
                'messageText'   => $message,
                'messageShowFormLink' => 1
                )
            );
        }

    /**
     * Get the operation and execute the method with its name
     */
    public function performOperation()
    {
        $operation = $this->getOperation();
        if ($operation) {
            $this->$operation();
        }
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
     */
    public function setLogsWriter(LogsWriter $logsWriter)
    {
        $this->logsWriter = $logsWriter;
    }
}
