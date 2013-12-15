<?php

namespace Setup\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use ServiceLocatorFactory\ServiceLocatorFactory;

/**
 * Merge Config and Language selection data to get app configuration setup data
 * @author Andrea Fiori
 * @since  11 December 2013
 */
class SetupController extends AbstractActionController
{

	private $em;
	
	/**
	 * set \ get the Doctrine\ORM\EntityManager or doctrine.entitymanager.orm_default EntityManager
	 */
	public function __construct()
	{
		$this->em = ServiceLocatorFactory::getInstance()->get('doctrine.entitymanager.orm_default');
	}
	
    public function getSetupRecord()
    {
    	$configRecord = $this->getConfigurations();
    	$configRecord['languagesLabels'] = $this->getLanguageLabels();
        return $configRecord;
    }
    
	    /**
	     * set path for the templates (this method can ben moved)
	     * @return array $configRecord
	     */
	    private function getConfigurations()
	    {
	    	
	    	$objectManager = ServiceLocatorFactory::getInstance()->get('');
	    	$user1 = $this->em->getRepository('Application\Entity\Users')->find(1);
	    	
	    	
	    	$configRepository = $this->em->getRepository('Application\Entity\Config')->findAll();
	    	$configRecord = array();
	    	foreach($configRepository as $configData)
	    	{
	    		$configRecord[$configData->getName()] = $configData->getValue();
	    	}
	    	$configRecord['projectdir'] = 'frontend/projects/'.$configRecord['remotelink'];
	    	if (!$configRecord['frontendtemplate']) $configRecord['frontendtemplate'] = 'default/';
	    	$configRecord['basiclayout'] = $configRecord['projectdir'].'templates/'.$configRecord['frontendtemplate'].'/layout.phtml';
	    	return $configRecord;
	    }
	    
	    /**
	     * @return array $languagesLabels 
	     */
	    private function getLanguageLabels()
	    {
	    	return $this->em->getRepository('Application\Entity\LanguagesLabels')->findAll();
	    }
}