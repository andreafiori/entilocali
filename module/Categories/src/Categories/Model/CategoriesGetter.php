<?php

namespace Categories\Model;

use Setup\SetupManager;
use Setup\QueryBuilderSetterAbstract;

/**
 * @author Andrea Fiori
 * @since  08 January 2014
 */
class CategoriesGetter extends QueryBuilderSetterAbstract
{
	/**
	 * @param SetupManager $setupManager
	 */
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;

		$this->setQueryBuilder( new CategoriesQueryBuilder() );
	}
	
	public function getCategoriesResult()
	{
		$this->getQueryBuilder()->setSetupManager($this->setupManager);
		$this->getQueryBuilder()->setQueryBasic();
		$this->getQueryBuilder()->setId( $this->getInput('id') );
	
		return $this->getQueryBuilder()->getSelectResult();
	}
}