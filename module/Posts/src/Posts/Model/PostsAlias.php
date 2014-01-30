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
		$postGetter = new PostsGetter($this->setupManager);
		$postGetter->setInput( $this->getPostsGetterInput() );

		$this->record = $postGetter->getCompletePostRecord();

		return $this->record;
	}
		
		private function getPostsGetterInput()
		{
			$input = $this->setupManager->getInput();
			
			unset($input['categoryName']);
			unset($input['title']);
			$input['helpers'] = true;
			$input['aliasnotull'] = true;
			$input['sortByAlias'] = true;

			return $input;
		}

	public function getRecord()
	{
		return $this->record;
	}
}