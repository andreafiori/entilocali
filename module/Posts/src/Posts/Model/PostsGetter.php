<?php

namespace Posts\Model;

use Setup\SetupManager;
use Posts\Model\PostsQueryBuilder;
use Setup\RecordsGetterAbstract;

/**
 * TODO:
 * 		different methods to get only posts data, posts without helpers records or only attachments !!!
 * 		get attachment\s
 * 		get template file as layout when set
 * 		get template file when there is one or more records
 * 		get seo tags if set
 *		if templatefile is set, get it as tempaltePartial; PAGING with adapter,
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
		
		$this->setPostsQueryBuilder( new PostsQueryBuilder() );
	}
	
	public function setPostsQueryBuilder(PostsQueryBuilder $postsQueryBuilder)
	{
		$this->postsQueryBuilder = $postsQueryBuilder;
		
		return $this->postsQueryBuilder;
	}
	
	public function getPostsQueryBuilder()
	{
		return $this->postsQueryBuilder;
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
	 * @return array
	 */
	public function getPost()
	{
		$this->getPostsQueryBuilder()->setSetupManager($this->setupManager);
		$this->getPostsQueryBuilder()->setQueryBasic();
		$this->getPostsQueryBuilder()->setBasicBindParameters();
		$this->getPostsQueryBuilder()->setLanguage($this->setupManager->getSetupManagerLanguages()->getLanguageId());
		$this->getPostsQueryBuilder()->setCategorySeoUrl( $this->setupManager->getInput('categoryName') );
		$this->getPostsQueryBuilder()->setSeoUrl( $this->setupManager->getInput('title') );
		$this->getPostsQueryBuilder()->setAliasNotNull( $this->setupManager->getInput('sortByAlias') );
		$this->getPostsQueryBuilder()->setParentId( $this->setupManager->getInput('parentid') );
		$this->getPostsQueryBuilder()->setParentIdCategory( $this->setupManager->getInput('parentidcategory') );

		$this->postsRecordsHelper = new PostsRecordsHelper( $this->getPostsQueryBuilder()->getSelectResult() );
		$this->getPostsRecordsHelper()->setSetupManager($this->setupManager);
		$this->getPostsRecordsHelper()->setRemotelinkWeb( $this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord('remotelinkWeb') );
		$this->getPostsRecordsHelper()->setAdditionalArrayElements();
		$this->getPostsRecordsHelper()->sortPostsByAlias( $this->setupManager->getInput('sortByAlias') );

		return $this->postsRecordsHelper->getPostsRecords();
	}
}