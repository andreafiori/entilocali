<?php

namespace Setup\Model;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * 
 * Merge Config and Language selection data to get app configuration setup data
 * @author Andrea Fiori
 * @since  11 December 2013
 * 
 */
class SetupManager
{
	private $em;
	
	public function __construct(ObjectManager $objectManager)
	{
		$this->em = $objectManager;
	}
	
	/**
	 * Given the input (channel name or vhost and\or language abbreviation), 
	 * get the setup array with all options  
	 * @return multitype:
	 */
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
	    	$configRepository = $this->em->getRepository('Application\Entity\Config')->findAll();
	    	$configRecord = array();
	    	foreach($configRepository as $configData)
	    	{
	    		$configRecord[$configData->getName()] = $configData->getValue();
	    	}
	    	$configRecord['projectdir'] = 'frontend/projects/'.$configRecord['remotelink'];
	    	if (!isset($configRecord['frontendtemplate'])) $configRecord['frontendtemplate'] = 'default/';
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