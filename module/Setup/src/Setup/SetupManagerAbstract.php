<?php

namespace Setup;

/**
 * Setup Manager Abstract Entity
 * @author Andrea Fiori
 * @since  30 December 2013
 */
abstract class SetupManagerAbstract {
	
	protected $input;
	protected $em;
	protected $setupRecord;
	protected $channelEntity;
	
	public function __construct(array $input)
	{
		$this->input = $input;
	
		return $input;
	}
	
	public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
	{
		$this->em = $entityManager;
	}
	
	public function getInput()
	{
		return $this->input;
	}
	
	public function getEntityManager()
	{
		return $this->em;
	}
}