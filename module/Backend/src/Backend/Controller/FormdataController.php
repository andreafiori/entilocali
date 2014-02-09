<?php

namespace Backend\Controller;

use Backend\Controller\BackendController;
use Zend\View\Helper\ViewModel;
use Backend\Model\FormSetterWrapper;
use Setup\SetupManager;

/**
 * @author Andrea Fiori
 * @since  07 February 2014
 */
class FormdataController extends BackendController
{
	/**
	 * @return \Zend\View\Model\ViewModel
	 */
	public function indexAction()
	{
		$setupManager = $this->generateSetupManagerFromInitializerPlugin();
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'formdata/form.phtml');
		
		if ( !$this->checkLoginSession($setupManager) ) {
			return $this->renderLoginForm($setupManager);
		}
		
		$this->setSetupManager($setupManager);
		
		$formSetterWrapper = $this->initializeFormSetterWrapper( new FormSetterWrapper($setupManager) );
		
		$this->layout( $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml' );
		$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );	
		$this->layout()->setVariable("form", $formSetterWrapper->getZendFormInstance());
		
		if ($formSetterWrapper->getFormSetterInstance()):
			$this->layout()->setVariable("formTitle", $formSetterWrapper->getFormSetterInstance()->getTitle());
			$this->layout()->setVariable("formDescription", $formSetterWrapper->getFormSetterInstance()->getDescription());
		endif;
		
		return new ViewModel();
	}
	
		/**
		 * @param SetupManager $setupManager
		 * @return \Backend\Model\FormSetterWrapper
		 */
		private function initializeFormSetterWrapper(FormSetterWrapper $formSetterWrapper)
		{
			$setupManager = $formSetterWrapper->getSetupManager();
			
			$formSetterWrapper->setFormSetterClassName( $this->params()->fromRoute('formsetter') );
			$formSetterWrapper->setFormSetterInstance();
			$formSetterWrapper->setFormSetterRecord( $this->params()->fromRoute('id') );
			$formSetterWrapper->setFormSetterAction();
			$formSetterWrapper->setFormSetterTitle();
			$formSetterWrapper->setFormSetterDescription();
			$formSetterWrapper->setZendFormClassName();
			$formSetterWrapper->setZendFormInstance();
			$formSetterWrapper->setFormRecord();
			
			if ($formSetterWrapper->getFormSetterInstance()):
				$action = $setupManager->getTemplateDataSetter()->getTemplateData('loggedSectionPathBackendWithLanguage').'formpost/'.$formSetterWrapper->getFormSetterInstance()->getAction();
				$formSetterWrapper->initializeForm($action);
				
				$request = $this->getRequest();
				if ( $request->isPost() )
				{
					$formSetterWrapper->getZendFormInstance()->setInputFilter($formSetterWrapper->getZendFormInstance()->getInputFilter());
					$formSetterWrapper->getZendFormInstance()->setData($request->getPost());
					$formSetterWrapper->getZendFormInstance()->isValid();
				}
			endif;
			
			return $formSetterWrapper;
		}
}