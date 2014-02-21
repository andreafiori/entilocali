<?php

namespace Setup;

/**
 * @author Andrea Fiori
 * @since  03 January 2014
 */
abstract class DQLQueryHelper
{
	protected $queryBasic, $query;

	protected $bindParameters = array();

	protected $setupManager;
	
	protected $defaultFieldsSelect;
	
	protected $queryContainer;
	
	protected $queryBuilder;
	
	protected $doctrineConfig;

	public function setSetupManager(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	
		return $this->setupManager;
	}
		
	public function setDefaultFieldsSelect($fieldList)
	{
		$this->defaultFieldsSelect = $fieldList;
		
		return $this->defaultFieldsSelect;
	}
	
	public function getDefaultFieldsSelect()
	{
		return $this->defaultFieldsSelect;
	}

	abstract public function setQueryBasic();
	
	public function getQueryBasic()
	{
		return $this->queryBasic;
	}

	public function setBindParameters(array $parameters)
	{
		$this->bindParameters = $parameters;

		return $this->bindParameters;
	}

	public function getBindParameters()
	{
		return $this->bindParameters;
	}

	public function addToBindParameters($key, $value)
	{
		$this->bindParameters[$key] = $value;
	}

	/**
	 * @return SetupManager
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}
	
	public function getSelectQuery()
	{
		if (!$this->queryBasic) {
			$this->setqueryBasic();
		}
		
		return $this->getQueryBasic().$this->query;
	}
	
	public function getSelectResult()
	{
		if ( !$this->getSetupManager() ) {
			throw new NullException('Setup Manager is not set on DQLQueryHelper');
		}

		$this->doctrineConfig = $this->getSetupManager()->getEntityManager()->getConfiguration();
		$this->doctrineConfig->addCustomDatetimeFunction('DATE_FORMAT', "\\Setup\\DateFormat");
		
		$this->getSetupManager()->getEntityManager()->create($this->getSetupManager()->getEntityManager()->getConnection(), $this->getDoctrineConfig());

		$query = $this->getSetupManager()->getEntityManager()->createQuery($this->getSelectQuery());
		$query->setParameters( $this->getBindParameters() );

		$this->queryContainer[] = $this->getSelectQuery();

		return $query->getResult();	
	}

	public function getDoctrineConfig()
	{
		return $this->doctrineConfig;
	}

	/**
	 * @return array
	 */
	public function getQueryContainer()
	{
		return $this->queryContainer;
	}

	/**
	 * TODO: Must return last insert id!!!
	 * @param string $tableName
	 * @param array $arrayData
	 */
	public function getInsertResult($tableName, array $arrayData)
	{
		$conn = $this->getSetupManager()->getEntityManager()->getConnection();
		try {
			$conn->beginTransaction();
			$conn->insert($tableName, $arrayData);
			$conn->commit();
			return true;
		} catch (NullException $e) {
			$conn->rollback();
			$e->getMessage();
			return false;
		}
	}
	/*
	public function getUpdateResult()
	{
		return false;
	}
	
	public function getDeleteResult()
	{
		return false;
	}
	*/
}