<?php

namespace Setup;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;

abstract class QueryMakerAbstract {

	protected $entityManager;
	protected $entitySerializer;
	protected $repository;
	protected $isOnBackend;

	public function __construct(ObjectManager $objectManager)
	{
		$this->entityManager = $objectManager;
		
		$this->setEntitySerializer( new EntitySerializer($objectManager) );
	}
	
	/**
	 * @return EntityManager $em
	 */
	public function getEntityManager()
	{
		return $this->entityManager;
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
	
	/**
	 * Inject the EntitySerializer object
	 * @param EntitySerializer $entitySerializer
	 * @return EntitySerializer $this->entitySerializer
	 */
	public function setEntitySerializer(EntitySerializer $entitySerializer)
	{
		$this->entitySerializer = $entitySerializer;
		return $this->entitySerializer;
	}

	public function setIsOnBackend($isOnBackend)
	{
		$this->isOnBackend = $isOnBackend;
	}
	
	public function isOnBackend()
	{
		return $this->isOnBackend;
	}
	
	/**
	 * @return EntitySerializer, $entitySerializer
	 */
	public function getEntitySerializer()
	{
		if (!$this->entitySerializer) {
			$this->entitySerializer = new EntitySerializer($this->getEntityManager());
		}
		
		return $this->entitySerializer;
	}

	public function getFindFromRepository($arraySearch = null, array $orderBy = null, $limit = null, $offset = null)
	{
		if (is_array($arraySearch)) {
			return $this->getEntityManager()->getRepository($this->repository)->findBy($arraySearch, $orderBy, $limit, $offset);
		} else {
			return $this->getEntityManager()->getRepository($this->repository)->findAll();
		}
	}

	public function convertArrayOfObjectToArray(array $arrayOfObject)
	{
		$arrayToReturn = array();
		foreach($arrayOfObject as &$arrayOfObject)
		{
			$arrayToReturn[] = $this->getEntitySerializer()->toArray($arrayOfObject);
		}
		return $arrayToReturn;
	}
}