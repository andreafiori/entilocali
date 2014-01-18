<?php

namespace Posts\Model;

use Setup\SetupManagerAbstract;
use Setup\SetupManagerPreloadInterface;

/**
 * get all posts sorted by alias 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class PostsAlias implements SetupManagerPreloadInterface
{
	private $setupManager, $record, $newInput;
	
	public function __construct(SetupManagerAbstract $setupManager)
	{
		$this->setupManager = $setupManager;
		
		$this->newInput = $this->setupManager->getInput();
		unset($this->newInput['categoryName']);
		unset($this->newInput['title']);
		$this->newInput['helpers'] = true;
		$this->newInput['aliasnotull'] = true;
		$this->newInput['sortByAlias'] = true;
		
		$this->setupManager->setInput($this->newInput);
	}
	
	public function setRecord()
	{
		if ( !$this->setupManager->getSetupManagerLanguages() ) {
			return false;
		}
		
		$setupManagerInstance = $this->setupManager;
		
		$postGetter = new PostsGetter($setupManagerInstance);

		$this->record = $postGetter->getPost();

		return $this->record;
	}
	
	/**
	 * @return array
	 */
	public function getRecord()
	{
		return $this->record;
	}
}