<?php

namespace Posts\Model;

use Setup\SetupManager;
use Posts\Model\PostsQueryBuilder;
use Setup\RecordsGetterAbstract;

/**
 * TODO:
 * 		get attachment\s 
 *		PAGING with adapter
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

	public function getCompletePostRecord()
	{
		$postsRecord = $this->getPostsRecordOnly($this->getInput());
		return $this->getPostsRecordsHelper( $postsRecord );
	}
	
	public function getPostsRecordOnly()
	{
		$this->getQueryBuilder()->setSetupManager($this->setupManager);
		$this->getQueryBuilder()->setQueryBasic();
		$this->getQueryBuilder()->setBasicBindParameters();
		$this->getQueryBuilder()->setId( $this->getInput('id') );
		$this->getQueryBuilder()->setLanguage($this->setupManager->getSetupManagerLanguages()->getLanguageId());
		$this->getQueryBuilder()->setCategorySeoUrl( $this->getInput('categoryName') );
		$this->getQueryBuilder()->setSeoUrl( $this->getInput('title') );
		$this->getQueryBuilder()->setAliasNotNull( $this->getInput('aliasnotull') );
		$this->getQueryBuilder()->setParentId( $this->getInput('parentid') );
		$this->getQueryBuilder()->setParentIdCategory( $this->getInput('parentidcategory') );
		
		return $this->getQueryBuilder()->getSelectResult();
	}
	
	public function getPostsRecordsHelper(array $posts)
	{
		$this->postsRecordsHelper = new PostsRecordsHelper($posts);
		$this->postsRecordsHelper->setSetupManager($this->setupManager);
		$this->postsRecordsHelper->setRemotelinkWeb( $this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord('remotelinkWeb') );
		$this->postsRecordsHelper->setAdditionalArrayElements();
		$this->postsRecordsHelper->sortPostsByAlias( $this->getInput('sortByAlias') );

		return $this->postsRecordsHelper->getPostsRecords();
	}

}