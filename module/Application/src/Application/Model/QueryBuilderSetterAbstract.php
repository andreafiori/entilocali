<?php

namespace Application\Model;

use Doctrine\ORM\QueryBuilder;

/**
 * Constructor to set and get QueryBuilder instance
 * 
 * @author Andrea Fiori
 * @since  02 April 2014
 */
abstract class QueryBuilderSetterAbstract {
	
	protected $queryBuilder;
	
	/**
	 * @param QueryBuilder $queryBuilder
	 */
	public function __construct(QueryBuilder $queryBuilder)
	{
		$this->queryBuilder = $queryBuilder;
	}
	
	/**
	 * @return QueryBuilder
	 */
	public function getQueryBuilder()
	{
		return $this->queryBuilder;
	}
}