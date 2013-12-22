<?php

namespace Setup\Model;

use Doctrine\Common\Persistence\ObjectManager;
use Setup\Model\EntitySerializer;

abstract class EntityRepositoryAbstract {
	
	protected $em, $entitySerializer;

	protected $repository, $isOnBackend;
	
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
	
	/**
	 * 
	 * @param EntitySerializer $entitySerializer
	 * @return EntitySerializer $this->entitySerializer
	 */
	public function setEntitySerializer(EntitySerializer $entitySerializer)
	{
		$this->entitySerializer = $entitySerializer;
		return $this->entitySerializer;
	}
	
	public function getEntitySerializer()
	{
		return $this->entitySerializer;
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

}