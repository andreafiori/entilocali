<?php

namespace Application\Model;

use Admin\Model\InputSetupAbstract;
use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  27 July 2013
 */
class RecordsGetterAbstract extends InputSetupAbstract
{
    /** @var if set, get first row of the recordset **/
    protected $firstRow;
    
    protected $records;
    
    protected $objectGetterWrapper;
    
    protected $entityManager;
    
    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return type
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        
        return $this->entityManager;
    }
    
    /**
     * @return \Doctrine\ORM\EntityManager|null
     */
    public function getEntityManager()
    {
        if (!$this->entityManager) {
            return $this->getInput('entityManager',1);
        }
        
        return $this->entityManager;
    }
    
    /**
     * @return 1
     */
    public function setFirstRow()
    {
        $this->firstRow = 1;

        return $this->firstRow;
    }
    
    /**
     * Return recordset or first row of the recordset if $this->firstRow is set
     * 
     * @return boolean|array
     */
    public function returnRecordset()
    {
        $records    = $this->getRecords();
        $firstRow   = $this->getFirstRow();
        
        if (!$records) {
            return false;
        }
        
        if ( !empty($firstRow) ) {
            foreach($records as $record){
                return $record;
            }
        }
        return $records;
    }
    
    /**
     * @param array $records
     * @return array
     */
    public function setRecords($records)
    {
        $this->records = $records;

        return $this->records;
    }
    
    public function getRecords()
    {
        return $this->records;
    }
    
    public function getFirstRow()
    {
        return $this->firstRow;
    }
    
    /**
     * @param string $idFieldName
     * @param string $valueFieldName
     * @return boolean|array
     */
    public function formatSezioniForFormSelect($idFieldName, $valueFieldName)
    {
        $recordset = $this->returnRecordset();
        if ($recordset) {
            $arrayToReturn = array();
            foreach($recordset as $record) {
                
                if (!isset($record[$idFieldName])) {
                    break;
                }
                
                $arrayToReturn[$record[$idFieldName]] = $record[$valueFieldName];
            }
            return $arrayToReturn;
        }
        
        return false;
    }
    
    /**
     * @param \Application\Model\RecordsGetterWrapperAbstract $objectGetterWrapper
     */
    public function setObjectGetterWrapper(RecordsGetterWrapperAbstract $objectGetterWrapper)
    {
        $this->objectGetterWrapper = $objectGetterWrapper;
    }
    
    /**
     * @return \Application\Model\RecordsGetterWrapperAbstract $objectGetterWrapper
     */
    public function getObjectGetterWrapper()
    {
        return $this->objectGetterWrapper;
    }
}
