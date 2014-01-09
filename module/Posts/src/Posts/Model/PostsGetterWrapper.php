<?php

namespace Posts\Model;

use Setup\SetupManager;
use Posts\Model\PostsQueryBuilder;

/**
 * 
 * @author Andrea Fiori
 * @since  08 January 2014
 */
class PostsGetterWrapper {
	
	private $input;
	private $setupManager;
	private $postsQueryBuilder, $postsRecordsHelper;
	
	/**
	 * 
	 * @param SetupManager $setupManager
	 */
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	/**
	 * 
	 * @param array $input
	 */
	public function setInput(array $input)
	{
		$this->input = $input;
	}
	
	public function getInput($key = null)
	{
		if ($key) {
			return $this->input[$key];
		}
		
		return $this->input;
	}
	
	public function getPost()
	{
		$this->postsQueryBuilder = new PostsQueryBuilder();
		$this->postsQueryBuilder->setSetupManager($this->setupManager);
		$this->postsQueryBuilder->setQueryBasic();
		$this->postsQueryBuilder->setBasicBindParameters();
		$this->postsQueryBuilder->setLanguage($this->setupManager->getLanguageId());
		$this->postsQueryBuilder->setAliasNotNull();
		
		if ( !$this->getInput("helpers") ) {
			return $this->postsQueryBuilder->getSelectResult();
		}

		$this->postsRecordsHelper = new PostsRecordsHelper($this->postsQueryBuilder->getSelectResult());
		$this->postsRecordsHelper->setSetupManager($this->setupManager);
		$this->postsRecordsHelper->setRemotelinkWeb($this->setupManager->getConfigRepository()->getConfigRecord('remotelinkWeb'));
		$this->postsRecordsHelper->setAdditionalArrayElements();
		$this->postsRecordsHelper->sortPostsByAlias( $this->getInput('sortByAlias') );
		
		
		return $this->postsRecordsHelper->getPostsRecords();
	}
}