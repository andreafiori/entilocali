<?php

namespace Setup\Model;

use Doctrine\Common\Persistence\ObjectManager;
use Zend\Mvc\Controller\AbstractActionController;
use Language\Model\LanguagesRepository;
use Config\Model\ConfigRepository;
use Language\Model\LanguagesLabelsRepository;

/**
 * Merge Config and Language selection data to get app configuration setup data
 * @author Andrea Fiori
 * @since  11 December 2013
 */
class SetupManager
{
	private $input = array();
	private $setupRecord = array();
	private $controller;
	private $em;
	
	private $languageRepository;
	
	public function __construct(AbstractActionController $controller)
	{
		$this->controller = $controller;
		
		/* set entity manager */
		$this->em = $this->controller->getServiceLocator()->get('entityManagerService');
		
		/* export the input on index controller? */
		$this->input['channel'] = 1;
		$this->ismultlanguage = 1;
		$this->input['isonbackend'] = 0;
		$this->input['controller']  = $this->controller->params()->fromRoute('controller');
		$this->input['action'] = $this->controller->params()->fromRoute('action');
		$this->input['languageAbbreviation'] = $this->controller->params()->fromRoute('lang');
	}
	
	/**
	 * inject the object manager
	 * @param ObjectManager $objectManager
	 */
	public function setObjectManager(ObjectManager $objectManager)
	{
		$this->em = $objectManager;
	}
	
	/**
	 * Given the input (channel name or vhost and\or language abbreviation), 
	 * get the setup array with all options  
	 * @return multitype:
	 */
    public function setSetupRecord()
    {
		$languageRepository = new LanguagesRepository($this->em);
		$languageRepository->setIsOnBackend($this->input['isonbackend']);
		$languageRepository->setAllAvailableLanguages($this->input['channel']);
		$defaultLanguage = $languageRepository->setDefaultLanguage( $this->input['languageAbbreviation'] );
		
		$languageLabelsRepository = new LanguagesLabelsRepository($this->em);
		//$languageLabelsRepository-> $this->em->getRepository('Application\Entity\LanguagesLabels')->findAll();
		//$this->setupRecord['languagesLabels'] = $this->em->getRepository('Application\Entity\LanguagesLabels')->findAll();
		
    	// Config values
		$configRepository = new ConfigRepository($this->em);
    	$configRepository = $this->em->getRepository('Application\Entity\Config')->findBy(
			array(
				"channelId"  => $this->input['channel'],
				//"languageId" => $defaultLanguage['id'],
				"isadmin" 	   => $this->input['isonbackend'],
    		)
    	);
		
    	$configRecord = array();
    	foreach($configRepository as $configData)
    	{
    		$configRecord[$configData->getName()] = $configData->getValue();
    	}
    	$configRecord['projectdir'] = 'frontend/projects/'.$configRecord['remotelink'];
    	if (!isset($configRecord['frontendtemplate']))
    			$configRecord['frontendtemplate'] = 'default/';
    	$configRecord['basiclayout'] = $configRecord['projectdir'].'templates/'.$configRecord['frontendtemplate'].'/layout.phtml';
    	
    	$this->setupRecord['channel'] = $this->input['channel'];
	    $this->setupRecord = array_merge($this->setupRecord, $configRecord);
	    
    	$this->setupRecord['languageAllAvailable'] = '';
    	$this->setupRecord['languageDefault'] = '';
    	
        return $this->setupRecord;
    }
}