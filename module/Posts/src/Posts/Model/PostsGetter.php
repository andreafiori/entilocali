<?php

namespace Posts\Model;

use Setup\SetupManager;
use Posts\Model\PostsQueryBuilder;

/**
 * 
 * @author Andrea Fiori
 * @since  08 January 2014
 */
class PostsGetter {
	
	private $input;
	
	private $setupManager;
	
	private $postsQueryBuilder, $postsRecordsHelper;
	
	/**
	 * @param SetupManager $setupManager
	 */
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	/**
	 * TODO:
	 * 		get attachment\s
	 * 		get template file as layout when set
	 * 		get template file when there is one or more records
	 * 		get seo tags if set
	 * 
    		if templatefile is set, get it as tempaltePartial; PAGING with adapter,
    		SEO tags if present, must be set
   	 
	 * @return Ambigous <\Setup\unknown, string, array>|Ambigous <unknown, multitype:string , multitype:unknown >
	 */
	public function getPost()
	{
		$this->postsQueryBuilder = new PostsQueryBuilder();
		$this->postsQueryBuilder->setSetupManager($this->setupManager);
		$this->postsQueryBuilder->setQueryBasic();
		$this->postsQueryBuilder->setBasicBindParameters();
		$this->postsQueryBuilder->setLanguage($this->setupManager->getSetupManagerLanguages()->getLanguageId());
		$this->postsQueryBuilder->setCategorySeoUrl( $this->setupManager->getInput('categoryName') );
		$this->postsQueryBuilder->setSeoUrl( $this->setupManager->getInput('title') );
		$this->postsQueryBuilder->setAliasNotNull( $this->setupManager->getInput('sortByAlias') );
		$this->postsQueryBuilder->setParentId( $this->setupManager->getInput('parentid') );
		$this->postsQueryBuilder->setParentIdCategory( $this->setupManager->getInput('parentidcategory') );

		if ( !$this->setupManager->getInput("helpers") ) {
			return $this->postsQueryBuilder->getSelectResult();
		}

		$this->postsRecordsHelper = new PostsRecordsHelper($this->postsQueryBuilder->getSelectResult());
		$this->postsRecordsHelper->setSetupManager($this->setupManager);
		$this->postsRecordsHelper->setRemotelinkWeb( $this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord('remotelinkWeb') );
		$this->postsRecordsHelper->setAdditionalArrayElements();
		$this->postsRecordsHelper->sortPostsByAlias( $this->setupManager->getInput('sortByAlias') );

		return $this->postsRecordsHelper->getPostsRecords();
	}
}