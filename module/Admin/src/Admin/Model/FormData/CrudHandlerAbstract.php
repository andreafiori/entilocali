<?php

namespace Admin\Model\FormData;

use Application\Model\RouterManagers\RouterManagerAbstract;

/**
 * @author Andrea Fiori
 * @since  01 June 2014
 */
abstract class CrudHandlerAbstract extends RouterManagerAbstract
{
    /** @var \Doctrine\DBAL\Connection */
    protected $connection;
    
    protected $allowedOperations = array("insert", "update", "update");
    protected $operation;

    protected $rawPost;
    protected $rawFiles;

    protected $arrayRecordToHandle = array();

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->setInput($input);
        
        $param = $this->getInput('param', 1);
        
        $this->rawPost  = $param['post'];
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
         * 
         * @param type $recordDBField
         * @param type $rawPostKey
         * @return array
         */
        protected function setArrayRecordToHandle($recordDBField, $rawPostKey)
        {
            if ( isset($this->rawPost[$rawPostKey]) ) {
                $this->arrayRecordToHandle[$recordDBField] = $this->rawPost[$rawPostKey];
            }

            return $this->arrayRecordToHandle;
        }
        
        protected function cleanArrayRecordToHandle()
        {
            $this->arrayRecordToHandle = array();
        }

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
        protected function setErrorMessage($errorMessage, $title = 'Errori verificati')
        {
            $this->setVariable('messageType', 'danger');
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
         */
        protected function setSuccessMessage($title = 'Operazione effettuata con successo', $message = 'I dati sono stati elaborati correttamente')
        {
            $this->setVariables(array(
                'messageType' => 'success',
                'messageTitle' => $title,
                'messageText' => $message,
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
}
