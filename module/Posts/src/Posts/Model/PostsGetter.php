<?php

namespace Posts\Model;

use Setup\SetupManager;
use Posts\Model\PostsQueryBuilder;
use Setup\RecordsGetterAbstract;

/**
 * TODO:
 * 		different methods to get only posts data, posts without helpers records or only attachments !!!
 * 		get attachment\s
 * 		get template file as "layout path" when set \ when there is one or more records
 *		if templatefile is set, get it as tempaltePartial; 
 *		PAGING with adapter,
 *		SEO tags if present, must be set
 * @author Andrea Fiori
 * @since  08 January 2014
 */
class PostsGetter extends RecordsGetterAbstract
{
	private $postsQueryBuilder, $postsRecordsHelper;
	
	/**
	 * @param SetupManager $setupManager
	 */
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
		
		$this->setQueryBuilder( new PostsQueryBuilder() );
	}
		
	public function setPostsRecordsHelper(PostsRecordsHelper $postsRecordsHelper)
	{
		$this->postsRecordsHelper = $postsRecordsHelper;
		
		return $this->postsRecordsHelper;
	}

	public function getPostsRecordsHelper()
	{
		return $this->postsRecordsHelper;
	}
	
	/**
	 * 
	 * @return array
	 */
	public function getPost()
	{
		$this->getQueryBuilder()->setSetupManager($this->setupManager);
		$this->getQueryBuilder()->setQueryBasic();
		$this->getQueryBuilder()->setBasicBindParameters();
		$this->getQueryBuilder()->setLanguage($this->setupManager->getSetupManagerLanguages()->getLanguageId());
		$this->getQueryBuilder()->setCategorySeoUrl( $this->setupManager->getInput('categoryName') );
		$this->getQueryBuilder()->setSeoUrl( $this->setupManager->getInput('title') );
		$this->getQueryBuilder()->setAliasNotNull( $this->setupManager->getInput('sortByAlias') );
		$this->getQueryBuilder()->setParentId( $this->setupManager->getInput('parentid') );
		$this->getQueryBuilder()->setParentIdCategory( $this->setupManager->getInput('parentidcategory') );

		$this->postsRecordsHelper = new PostsRecordsHelper( $this->getQueryBuilder()->getSelectResult() );
		$this->getPostsRecordsHelper()->setSetupManager($this->setupManager);
		$this->getPostsRecordsHelper()->setRemotelinkWeb( $this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord('remotelinkWeb') );
		$this->getPostsRecordsHelper()->setAdditionalArrayElements();
		$this->getPostsRecordsHelper()->sortPostsByAlias( $this->setupManager->getInput('sortByAlias') );

		return $this->postsRecordsHelper->getPostsRecords();
	}
}