<?php

namespace Application\Setup;

use Application\Model\NullException;

/**
 * Help to set language parameters on the setup
 * 
 * @author Andrea Fiori
 * @since  26 April 2014
 */
class LanguagesSetupManager
{
    private $isMultiLanguage;
    private $languagesSetup;
    private $languagesLabelsSetup;
    private $languageAbbreviation;

    /**
     * @param \Application\Setup\LanguagesLabelsSetup $languagesLabelsSetup
     */
    public function setLanguagesLabelsSetup(LanguagesLabelsSetup $languagesLabelsSetup)
    {
        $this->languagesLabelsSetup = $languagesLabelsSetup;
    }
    
    /**
     * @return \Application\Setup\LanguagesLabelsSetup $languagesLabelsSetup
     */
    public function getLanguagesLabelsSetup()
    {
        return $this->languagesLabelsSetup;
    }
    
    /**
     * @param number $isMultiLanguage
     */
    public function setIsMultiLanguage($isMultiLanguage)
    {
        $this->isMultiLanguage = $isMultiLanguage;
    }
    
    /**
     * @param type $languageAbbreviation
     */
    public function setLanguageAbbreviation($languageAbbreviation)
    {
        if (is_string($languageAbbreviation)) {
            $this->languageAbbreviation = $languageAbbreviation;   
        }
    }
    
    public function getLanguageAbbreviation()
    {
        return $this->languageAbbreviation;
    }
    
    public function isMultiLanguage()
    {
        return $this->isMultiLanguage ? $this->isMultiLanguage : false;
    }

    public function setLanguagesSetup(LanguagesSetup $languagesSetup)
    {
        $this->languagesSetup = $languagesSetup;
        
        return $this->languagesSetup;
    }
    
    public function getLanguagesSetup()
    {
        return $this->languagesSetup;
    }
    
    /**
     * Main method to get all languages configurations
     * 
     * @param number $channel
     * @return array
     * @throws NullException
     */
    public function generateLanguageRecord($channel = 1)
    {
        if ( $this->isMultiLanguage() ) {
            
            if ( !$this->getLanguagesSetup() ) {
                throw new NullException("Languages Setup Object is not set");
            }
        
            if ( !$this->getLanguagesLabelsSetup() ) {
                throw new NullException("Languages Setup Labels Object is not set");
            }

            $languageId = $this->getLanguagesSetup()->setLanguageId();
            
            return array(
                    "availableLanguages" => $this->getLanguagesSetup()->setAllAvailableLanguages($channel),
                    "defaultLanguage"    => $this->getLanguagesSetup()->setDefaultLanguage($this->getLanguageAbbreviation()),
                    "languageId"         => $languageId,
                    "languagesLabels"    => $this->getLanguagesLabelsSetup()->setLanguagesLabels($languageId),
                );
            
        } else {
            return array( "languageId" => 1 );
        }
    }

}