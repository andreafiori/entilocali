<?php

namespace Setup\Model;

use Doctrine\Common\Persistence\ObjectManager,
	Zend\Mvc\Controller\AbstractActionController,
	Language\Model\LanguagesRepository,
	Config\Model\ConfigRepository,
	Language\Model\LanguagesLabelsRepository,
	Setup\Model\EntitySerializer;
use Application\Entity\Channels;

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
		
		$this->em = $this->controller->getServiceLocator()->get('entityManagerService');
		
		/* Export the input on index controller? */
		$this->input['channel'] = 1;
		$this->ismultlanguage = 1;
		$this->input['isonbackend'] = 0;
		$this->input['controller']  = $this->controller->params()->fromRoute('controller');
		$this->input['action'] = $this->controller->params()->fromRoute('action');
		$this->input['languageAbbreviation'] = strtolower( $this->controller->params()->fromRoute('lang') );
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
    	$channelEntity = new Channels();
    	$channelEntity->setId($this->input['channel']);
    	
		$languageRepository = new LanguagesRepository($this->em);
		$languageRepository->setEntitySerializer( new EntitySerializer($this->em) );
		$languageRepository->setIsOnBackend($this->input['isonbackend']);
		$allAvailableLanguages = $languageRepository->setAllAvailableLanguages($channelEntity);
		$defaultLanguage = $languageRepository->setDefaultLanguage($this->input['languageAbbreviation']);
		
		$languageLabelsRepository = new LanguagesLabelsRepository($this->em);
		//$languageLabelsRepository-> $this->em->getRepository('Application\Entity\LanguagesLabels')->findAll();
		//$this->setupRecord['languagesLabels'] = $this->em->getRepository('Application\Entity\LanguagesLabels')->findAll();
		
    	// Config values
		$configRepository = new ConfigRepository($this->em);
    	$configRepository = $this->em->getRepository('Application\Entity\Config')->findBy(
			array(
				"channel"  => $defaultLanguage->getChannel(),
				"isadmin"  => $this->input['isonbackend'],
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
    	$configRecord['basiclayout'] = $configRecord['projectdir'].'templates/'.$configRecord['frontendtemplate'].'layout.phtml';

    	$this->setupRecord['channel'] = $this->input['channel'];
	    $this->setupRecord = array_merge($this->setupRecord, $configRecord);
    	$this->setupRecord['languageAllAvailable'] = '';
    	$this->setupRecord['languageDefault'] = '';
    	
        return $this->setupRecord;
    }
}