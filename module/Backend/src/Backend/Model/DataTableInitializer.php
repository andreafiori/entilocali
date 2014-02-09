<?php

namespace Backend\Model;

use Setup\SetupManager;

/**
 * @author Andrea Fiori
 * @since  09 February 2014
 */
class DataTableInitializer extends DatatableInitializerAbstract implements DataTableInitializerInterface
{
	public function __construct(SetupManager $setupManager)
	{
		$this->setSetupManager($setupManager);

		$this->setLabels($setupManager->getSetupManagerLanguagesLabels()->getLanguageLabels());
	}
	
	public function setTitle()
	{
		$this->title = $this->getInitializer()->setTitle();

		return $this->title;
	}

	public function setDescription()
	{
		$this->description = $this->getInitializer()->setDescription();
		
		return $this->description;
	}
	
	/**
	 * @return array
	 */
	public function setColumns()
	{
		$this->columns = $this->getInitializer()->setColumns();
		
		return $this->columns;
	}
	
	/**
	 * @return array
	 */
	public function setColumnsValues()
	{
		$this->columnsValues = $this->getInitializer()->getColumnsValues();
		
		return $this->columnsValues;
	}
}