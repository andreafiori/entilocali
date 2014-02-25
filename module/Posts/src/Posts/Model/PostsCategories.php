<?php

namespace Posts\Model;

use Setup\SetupManagerAbstract;
use Setup\SetupManagerPreloadInterface;
use Setup\SetupManagerPreloadAbstract;

/**
 * Get posts ordered by categories
 * @author Andrea Fiori
 * @since  23 January 2014
 */
class PostsCategories extends SetupManagerPreloadAbstract implements SetupManagerPreloadInterface
{	
	/**
	 * @param SetupManagerAbstract $setupManager
	 */
	public function __construct(SetupManagerAbstract $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	public function setRecord()
	{
		
		return $this->record;
	}

	public function getRecord()
	{
		return $this->record;
	}
}