<?php

namespace Setup\Model;

use Doctrine\Common\Persistence\ObjectManager;

abstract class EntityRepositoryAbstract {

	protected $input, $em, $repository;
	
	protected $isOnBackend;
	
	public function __construct(ObjectManager $objectManager)
	{
		$this->em = $objectManager;
	}
	
	/**
	 * @return ObjectManager $em
	 */
	public function getObjectManager()
	{
		return $this->em;
	}
	
	public function setRepository($repo)
	{
		$this->repository = $repo;
		return $this->repository;
	}
	
	public function getRepository()
	{
		return $this->repository;
	}
	
	public function setInput($input)
	{
		$this->input = $input;
		return $this->input;
	}
	
	public function getInput()
	{
		return $this->input;
	}

	public function setIsOnBackend($isOnBackend)
	{
		$this->isOnBackend = $isOnBackend;
		return $this->isOnBackend;
	}
	
	public function isOnBackend()
	{
		return $this->isOnBackend;
	}
	
		/**
		 * Convert object entity result (multiple object\s) to multiple array\s
		 * @param unknown $obj
		 * @return array
		 */
		protected function convertObjectToArray($obj)
		{
			$arrayRecord = (array) $obj;
			$arrayToReturn = array();
			foreach($arrayRecord as $arrayRecord)
			{
				$record = array();
				$arrayRecord = (array) $arrayRecord;
				foreach($arrayRecord as $key => $value)
				{
					$record[trim(str_replace($this->repository, '', $key))] = $value;
				}
				$arrayToReturn[] = $record;
			}
			return $arrayToReturn;
		}
	
}