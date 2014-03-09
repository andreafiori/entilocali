<?php

namespace Posts\Model;

use Setup\SetupManager;
use Posts\Model\PostsQueryBuilder;
use Setup\QueryBuilderSetterAbstract;

/**
 * TODO:
 * 		get attachment\s 
 *		PAGING with adapter
 *		select all post for all available language and get the switchlink
 * @author Andrea Fiori
 * @since  08 January 2014
 */
class PostsGetter extends QueryBuilderSetterAbstract
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

	public function getCompletePostRecord()
	{
		$postsRecords = $this->getPostsRecordOnly( $this->getInput() );

		return $this->getPostsRecordsHelper( new PostsRecordsHelper($postsRecords) );
	}

	public function getPostsRecordOnly()
	{
		$this->getQueryBuilder()->setSetupManager($this->setupManager);
		$this->getQueryBuilder()->setQueryBasic();
		$this->getQueryBuilder()->setBasicBindParameters();
		$this->getQueryBuilder()->setDefaultFieldsSelect( $this->getInput('fieldList') );
		$this->getQueryBuilder()->setId( $this->getInput('id') );
		$this->getQueryBuilder()->setLanguage( $this->setupManager->getSetupManagerLanguages()->getLanguageId() );
		$this->getQueryBuilder()->setCategorySeoUrl( $this->getInput('categoryName') );
		$this->getQueryBuilder()->setSeoUrl( $this->getInput('title') );
		$this->getQueryBuilder()->setAliasNotNull( $this->getInput('aliasnotull') );
		$this->getQueryBuilder()->setParentId( $this->getInput('parentid') );
		$this->getQueryBuilder()->setParentIdCategory( $this->getInput('parentidcategory') );
		$this->getQueryBuilder()->setTypeofpost( $this->getInput('typeofpost') );
		$this->getQueryBuilder()->setOrderBy( $this->getInput('orderBy') ? $this->getInput('orderBy') : "p.insertdate DESC");
		
		return $this->getQueryBuilder()->getSelectResult();
	}

	public function getPostsRecordsHelper(PostsRecordsHelper $postsRecordsHelper)
	{
		$this->postsRecordsHelper = $postsRecordsHelper;
		$this->postsRecordsHelper->setSetupManager($this->setupManager);
		$this->postsRecordsHelper->setRemotelinkWeb( $this->setupManager->getSetupManagerConfigurations()->getConfigurations('remotelinkWeb') );
		$this->postsRecordsHelper->setAdditionalArrayElements();
		$this->postsRecordsHelper->sortPostsByAlias( $this->getInput('sortByAlias') );

		return $this->postsRecordsHelper->getPostsRecords();
	}
}