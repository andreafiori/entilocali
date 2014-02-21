<?php

namespace Posts\Model;

use Setup\SetupManagerAbstract;
/**
 * 
 * @author afiori
 *
 */
class PostsCategories
{
	private $setupManager;
	
	private $postsGetterInput;
	
	private $record;
	
	/**
	 * @param SetupManagerAbstract $setupManager
	 */
	public function __construct(SetupManagerAbstract $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	public function setRecord()
	{
		$postsGetter = new PostsGetter($this->setupManager);
				
		return $this->record;
	}
	
	public function getRecord()
	{
		return $this->record;
	}	
}