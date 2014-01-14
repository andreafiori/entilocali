<?php

namespace Posts\Model;

use Setup\SetupManagerAbstract;
use Setup\SetupManagerAlwaysToLoadInterface;

/**
 * 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class PostsAlias implements SetupManagerAlwaysToLoadInterface
{
	private $setupManager, $record;
	
	public function __construct(SetupManagerAbstract $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	public function setRecord()
	{
		if ( !$this->setupManager->getSetupManagerLanguages() ) {
			return false;
		}
		
		$postsQueryBuilder = new PostsQueryBuilder();
		$postsQueryBuilder->setSetupManager($this->setupManager);
		$postsQueryBuilder->setQueryBasic();
		$postsQueryBuilder->setBasicBindParameters();
		$postsQueryBuilder->setLanguage($this->setupManager->getSetupManagerLanguages()->getLanguageId());
		$postsQueryBuilder->setAliasNotNull();
		
		$postsRecordsHelper = new PostsRecordsHelper($postsQueryBuilder->getSelectResult());
		$postsRecordsHelper->setSetupManager($this->setupManager);
		$postsRecordsHelper->setRemotelinkWeb($this->setupManager->getSetupManagerConfigurations()->getConfigRepository()->getConfigRecord('remotelinkWeb'));
		$postsRecordsHelper->setAdditionalArrayElements();
		
		$this->record = $postsRecordsHelper->sortPostsByAlias(true);
	}
	
	public function getRecord()
	{
		return $this->record;
	}
}