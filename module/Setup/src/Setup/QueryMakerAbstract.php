<?php

namespace Setup;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;

/**
 * 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
abstract class QueryMakerAbstract
{
	protected $entityManager;
	protected $entitySerializer;
	protected $repository;

	public function __construct(ObjectManager $objectManager)
	{
		$this->entityManager = $objectManager;

		$this->setEntitySerializer( new EntitySerializer($objectManager) );
		$this->setRepository();
	}

	public function setEntityManager(ObjectManager $objectManager)
	{
		$this->entityManager = $objectManager;
	}

	public function setRepository($repo = null)
	{
		if ($repo) {
			$this->repository = $repo;
		}
				
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
	
	public function convertArrayOfObjectToArray(array $arrayOfObject)
	{
		$arrayToReturn = array();
		foreach($arrayOfObject as &$arrayOfObject)
		{
			$arrayToReturn[] = $this->getEntitySerializer()->toArray($arrayOfObject);
		}
		return $arrayToReturn;
	}

	/**
	 * @return EntityManager $em
	 */
	public function getEntityManager()
	{
		return $this->entityManager;
	}

	public function getRepository()
	{
		return $this->repository;
	}

	public function getFindFromRepository($arraySearch = null, array $orderBy = null, $limit = null, $offset = null)
	{
		if (is_array($arraySearch)) {
			return $this->getEntityManager()->getRepository($this->getRepository())->findBy($arraySearch, $orderBy, $limit, $offset);
		} else {
			return $this->getEntityManager()->getRepository($this->getRepository())->findAll();
		}
	}
}