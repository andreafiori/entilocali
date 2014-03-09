<?php

namespace Backend\Controller;

use Backend\Controller\BackendController;
use Zend\View\Helper\ViewModel;
use Backend\Model\DataTableInitializer;
use Posts\Model\PostsDatatable;

/**
 * @author Andrea Fiori
 * @since  07 February 2014
 */
class DatatableController extends BackendController
{
	private $dataTableInitializer;
	
	/**
	 * @return \Zend\View\Model\ViewModel
	 */
	public function indexAction()
	{
		$setupManager = $this->generateSetupManagerFromInitializerPlugin();
	
		if ( !$this->checkLoginSession($setupManager) ) {
			return $this->renderLoginForm($setupManager);
		}
		
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'datatable/datatable.phtml');
		
		$initializerObject = $this->params()->fromRoute('initializer');
		$initializerObject = new PostsDatatable($setupManager);
		
		$datatableInitializer = new DataTableInitializer($setupManager);
		$datatableInitializer->setInput(array(
			"route"			=> $this->params()->fromRoute(),
			"get"			=> $this->params()->fromQuery(),
			"uri"			=> $this->getRequest()->getUri()
		));
		$datatableInitializer->setTitle( $initializerObject->setTitle() );
		$datatableInitializer->setDescription( $initializerObject->setDescription() );
		$datatableInitializer->setColumns( $initializerObject->setColumns() );
		$datatableInitializer->setColumnsValues( $initializerObject->setColumnsValues() );
		
		$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
		$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
		$this->layout()->setVariable("title", $datatableInitializer->getTitle());
		$this->layout()->setVariable("description", $datatableInitializer->getDescription());
		$this->layout()->setVariable("columns", $datatableInitializer->getColumns());
		$this->layout()->setVariable("columnsValues", $datatableInitializer->getColumnsValues());
		
		return new ViewModel();
	}
}