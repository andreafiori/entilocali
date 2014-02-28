<?php

namespace Setup;

/**
 * Manage channel, language, config, template settings
 * TODO: channel detection, inject object separately... 
 * @author Andrea Fiori
 * @since  11 December 2013
 */
class SetupManager extends SetupManagerAbstract
{
	public function __construct(array $input)
	{
		$this->input = $input;
		
		$this->setupManagerLanguages 		= new SetupManagerLanguages();
		$this->setupManagerLanguagesLabels	= new SetupManagerLanguagesLabels();
		$this->setupManagerConfigurations 	= new SetupManagerConfigurations();
		$this->setupManagerPreload			= new SetupManagerPreload();
	}

	public function setChannelId()
	{
		$this->channelId = 1;
		
		return $this->channelId;
	}

    /**
     * @param TemplateDataSetter $templateDataSetter
     */
    public function setTemplateDataSetter(TemplateDataSetter $templateDataSetter)
    {
    	$this->templateDataSetter = $templateDataSetter;
    }
    
    /**
     * @return TemplateDataSetter
     */
    public function getTemplateDataSetter()
    {
    	return $this->templateDataSetter;
    }

    /**
     * set the mandatory class to load on home page 
     * @param string $className
     * @throws NullException
     */
    public function setControllerHomePage($className)
    {
    	if ( !class_exists($className) ) {
    		throw new NullException('Controller class on home page is not an object');
    	}
    	
    	$this->controllerHomePage = $className;
    	
    	return $this->controllerHomePage;
    }

    public function getControllerHomePage()
    {
    	return $this->controllerHomePage;
    }
}