<?php

namespace Setup;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Get the Object Manager (injected from the config\autoload\global.php)
 * @author Andreaa Fiori
 * @since  16 December 2013
 */
class EntityManagerService {
	
	private $em;
	
	private $repository;
	
	public function __construct(ObjectManager $objectManager)
	{
		$this->em = $objectManager;
	}
	
	/**
	 * set the entity as repository
	 * @param string $repository
	 */
	public function setRepository($repository)
	{
		return $this->em->getRepository($repository);
	}
	
	/**
	 * get the object manager
	 * @return ObjectManager $this->em
	 */
	public function getObjectManager()
	{
		return $this->em;
	}
}