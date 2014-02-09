<?php

namespace Backend\Model;

use Setup\SetupManager;

/**
 * @author Andrea Fiori
 * @since  09 February 2014
 */
class DatatableInitializerAbstract extends DataTableAbstract implements DatatableInitializerInterface
{
	public function __construct(SetupManager $setupManager)
	{
		$this->setSetupManager($setupManager);

		$this->setLabels($setupManager->getSetupManagerLanguagesLabels()->getLanguageLabels());
	}

	public function setTitle()
	{
		$this->getInitializer()->setTitle();
		
		return $this->getInitializer()->getTitle();
	}

	public function setDescription()
	{
		$this->getInitializer()->setDescription();
		
		return $this->getInitializer()->getDescription();
	}

	public function setColumns()
	{
		$this->getInitializer()->setColumns();
		
		return $this->getInitializer()->getColumns();
	}

	public function setColumnsValues()
	{
		$this->getInitializer()->setColumnsValues();
		
		return $this->getInitializer()->getColumnsValues();
	}
}