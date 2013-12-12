<?php

namespace Setup\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use ServiceLocatorFactory\ServiceLocatorFactory;
use Config\Model\ConfigTable;
// use Language\Model\LanguageTable;


/**
 * Merge Config and Language selection data to get app configuration setup data
 * @author Andrea Fiori
 * @since  11 December 2013
 */
class SetupController extends AbstractActionController
{
	private $configTable;
	private $languageTable, $langaugeLabelsTable;
	
    public function getSetupRecord()
    {
    	$configTable = $this->getConfigTable();
    	$configFromDb = $configTable->fetchAll(
    			array(
    				'rifchannel' => array(1, 0),
    				'riflanguage' => array(1, 0),
    				'isadmin' => 0
    			)
    	);
    	
    	$languageTable = $this->getLanguageTable();
    	$languageFromDb = $languageTable->fetchAll();
    	
    	$setupRecord = $configFromDb;
    	$setupRecord->languages = $languageFromDb;
        return $setupRecord;
    }
	    
	    /**
	     * @return ConfigTable $configTable
	     */
	    private function getConfigTable()
	    {
	    	if (!$this->configTable) {
	    		$this->configTable = ServiceLocatorFactory::getInstance()->get('Config\Model\ConfigTable');
	    	}
	    	
	    	return $this->configTable;
	    }
	    
	    /**
	     * @return ConfigTable $configTable
	     */
	    private function getLanguageTable()
	    {
	    	if (!$this->languageTable) {
	    		$this->languageTable = ServiceLocatorFactory::getInstance()->get('Language\Model\LanguageTable');
	    	}
	    	return $this->languageTable;
	    }
	    
	    private function getLanguageLabelsTable()
	    {
	    	
	    }
}
