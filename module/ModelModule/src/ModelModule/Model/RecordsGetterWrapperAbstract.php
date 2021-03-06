<?php

namespace ModelModule\Model;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;

abstract class RecordsGetterWrapperAbstract
{
    protected $input;

    /**
     * @var QueryBuilderHelperAbstract
     */
    protected $objectGetter;
    
    protected $query;

    /**
     * @var \Zend\Paginator\Paginator
     */
    protected $paginator;
    
    protected $firstResult = 0;
    protected $maxResults;
    protected $perpageDefault = 8;

    protected $entityManager;

    protected $attachmentsGetterWrapper;

    /**
     * @param array $input
     */
    public function setInput(array $input)
    {
        $this->input = $input;
        
        return $this->input;
    }
    
    /**
     * @param string $key
     * @param bool|array
     *
     * @return mixed
     */
    public function getInput($key = null, $noArray = null)
    {
        if ( isset($this->input[$key]) ) {
            return $this->input[$key];
        }
        
        if (!$noArray) {
            return $this->input;
        }

        return false;
    }
    
    abstract public function setupQueryBuilder();
    
    /**
     * @return \ModelModule\Model\QueryBuilderHelperAbstract
     */
    public function setObjectGetter(QueryBuilderHelperAbstract $objectGetter)
    {
        $this->objectGetter = $objectGetter;
        
        return $this->objectGetter;
    }
    
    /**
     * @return QueryBuilderHelperAbstract
     */
    public function getObjectGetter()
    {
        return $this->objectGetter;
    }

    /**
     * @return QueryBuilderHelperAbstract
     * @throws NullException
     */
    public function getRecords()
    {
        if (!$this->objectGetter) {
            throw new NullException("ObjectGetter is not set");
        }
        
        return $this->convertToUft8( $this->objectGetter->getQueryResult() );
    }

    /**
     * Convert recordset int ocd
     *
     * @param array $recordset
     * @return array
     */
    private function convertToUft8($recordset)
    {
        if (!empty($recordset)) {
            foreach($recordset as $num => $records) {
                foreach($records as $key => $value) {
                    $value = $recordset[$num][$key];
                    if (is_string($value)) {
                        $recordset[$num][$key] = utf8_encode($value);
                    }
                }
            }

            return $recordset;
        }

        return null;
    }
    
    /**
     * @param array $queryRecords
     * @return \Zend\Paginator\Paginator
     */
    public function setupPaginator(array $queryRecords)
    {
        $this->paginator = new Paginator( new ArrayAdapter($queryRecords) );

        return $this->paginator;
    }

    /**
     * Setup query (for paginator)
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return string|array
     */
    public function setupQuery(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->query = $entityManager->createQuery( $this->getObjectGetter()->getDQLQuery() )
                                     ->setFirstResult($this->firstResult)
                                     ->setMaxResults($this->maxResults)
                                     ->setParameters( $this->getObjectGetter()->getQuery()->getParameters() )
                                     ->getScalarResult();

        return $this->query ? $this->query : array();
    }
    
    /**
     * @param int $page
     * @return \Zend\Paginator\Paginator
     */
    public function setupPaginatorCurrentPage($page)
    {
        $this->assertPaginator();
        
        if ( !is_numeric($page) ) {
            $page = 1;
        }

        $this->paginator->setCurrentPageNumber($page);

        return $this->paginator;
    }
    
    /**
     * @param int $perpage
     * @return \Zend\Paginator\Paginator
     */
    public function setupPaginatorItemsPerPage($perpage = null)
    {
        $this->assertPaginator();
        
        if ( !is_numeric($perpage) ) {
            $perpage = $this->perpageDefault;
        }
        
        $this->paginator->setItemCountPerPage($perpage);
        
        return $this->paginator;
    }
    
        /**
         * @throws NullException
         */
        private function assertPaginator()
        {
            if (!$this->paginator) {
                throw new NullException('Zend Paginator must be set. Use setupPaginator first');
            }
        }

    /**
     * Add array records to the paginator recordset
     * 
     * @return \stdClass
     * @throws NullException
     */
    public function setupRecords()
    {
        if (!$this->paginator) {
            throw new NullException("Setup paginator before setting additional records");
        }
        
        return $this->paginator;
    }
    
    /**
     * Query must be set using entity manager and scalarResult on child classes
     * 
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }
    
    /**
     * @return \Zend\Paginator\Paginator $paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * @return int
     */
    public function getFirstResult()
    {
        return $this->firstResult;
    }

    /**
     * @return int
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * Add attachments records to an existing recordset
     *
     * @param array $records
     * @param array $input
     *
     * @return array|bool
     */
    public function addAttachmentsFromRecords($records, $input = array())
    {
        if ( empty($records) ) {
            return false;
        }

        $this->assertEntityManager();

        foreach($records as &$record) {
            $attachments = new AttachmentsGetterWrapper( new AttachmentsGetter($this->getEntityManager()) );
            $attachments->setInput(array_merge(
                $input,
                array('referenceId' => isset($record['id']) ? $record['id'] : null)
            ));
            $attachments->setupQueryBuilder();

            $attachmentsRecords = $attachments->getRecords();

            if (!empty($attachmentsRecords)) {
                $record['attachments'] = $attachmentsRecords;
            }
        }

        return $records;
    }

    /**
     * @param AttachmentsGetterWrapper $attachmentsGetterWrapper
     */
    public function setAttachmentsGetterWrapper(AttachmentsGetterWrapper $attachmentsGetterWrapper)
    {
        $this->attachmentsGetterWrapper = $attachmentsGetterWrapper;
    }

    /**
     * @return AttachmentsGetterWrapper
     */
    public function getAttachmentsGetterWrapper()
    {
        return $this->attachmentsGetterWrapper;
    }

    /**
     * @return AttachmentsGetterWrapper
     */
    protected function assertAttachmentsGetterWrapper()
    {
        if (!$this->getAttachmentsGetterWrapper()) {
            $this->setAttachmentsGetterWrapper(
                new AttachmentsGetterWrapper(new AttachmentsGetter($this->getEntityManager()))
            );
        }

        return $this->getAttachmentsGetterWrapper();
    }

    /**
     * Add attachment records to the input recordset
     *
     * @param mixed $records
     * @param array $input
     * @return bool
     */
    public function addAttachmentsToPaginatorRecords($records, $input = array())
    {
        if ( empty($records) ) {
            return false;
        }

        $this->assertEntityManager();

        foreach($records as $key => &$value) {

            $attachments = new AttachmentsGetterWrapper( new AttachmentsGetter($this->getEntityManager()) );
            $attachments->setInput(array_merge(
                $input,
                array('referenceId' => isset($value['id']) ? $value['id'] : null)
            ));
            $attachments->setupQueryBuilder();

            $attachmentsRecords = $attachments->getRecords();
            
            if (!empty($attachmentsRecords)) {
                $value['attachments'] = $attachmentsRecords;
            }
        }

        return $records;
    }

    /**
     * @throws NullException
     */
    protected function assertEntityManager()
    {
        if (!$this->getEntityManager()) {
            throw new NullException("Set EntityManager on Wrapper Input to select attachment files");
        }
    }

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param array $recordset
     * @param $idFieldName
     * @param $valueFieldName
     * @return array|bool
     */
    public function formatForDropwdown($recordset, $idFieldName, $valueFieldName)
    {
        if (!empty($recordset)) {
            $arrayToReturn = array();
            foreach($recordset as $record) {

                if (!isset($record[$idFieldName])) {
                    break;
                }

                $arrayToReturn[$record[$idFieldName]] = isset($record[$valueFieldName]) ? $record[$valueFieldName] : null;
            }
            return $arrayToReturn;
        }

        return false;
    }
}