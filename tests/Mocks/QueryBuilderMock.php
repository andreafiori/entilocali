<?php

namespace Mocks;

use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\ArrayCollection;


class MockQueryBuilder extends QueryBuilder
{
	protected $expr;
	
	protected $paramReflect;

	public function __construct($expr)
	{
		$this->expr = $expr;
		$this->paramReflect = new \ReflectionProperty('Doctrine\ORM\QueryBuilder', 'parameters');
		$this->paramReflect->setAccessible(true);
		$this->paramReflect->setValue($this, new ArrayCollection());
	}

	/*
	 * @return Query\Expr
	*/
	public function expr()
	{
		return $this->expr;
	}

	public function getEntityManager()
	{
		return null;
	}

	public function getQuery()
	{
		return array(
				'parameters' => clone $this->paramReflect->getValue($this),
				'dql' => $this->getDQL(),
		);
	}
}