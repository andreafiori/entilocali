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

    private $arrayRecordToHandle = array();

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->setInput($input);
        
        $param = $this->getInput('param', 1);
        
        $this->rawPost  = $param['post'];
        $this->rawFiles = $param['files'];
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
    
    protected function getArrayRecordToHandle()
    {
        return $this->arrayRecordToHandle;
    }
}