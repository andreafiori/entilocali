<?php

namespace ModelModuleTest\Setup;

use ModelModuleTest\TestSuite;
use ModelModule\Setup\LanguagesSetup;
use ModelModule\Setup\LanguagesLabelsSetup;
use ModelModule\Setup\LanguagesSetupManager;

class LanguagesSetupManagerTest extends TestSuite
{
    private $languagesSetupManager;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->languagesSetupManager = new LanguagesSetupManager();
    }
    
    public function testSetLanguagesSetup()
    {
        $this->languagesSetupManager->setLanguagesSetup( new LanguagesSetup($this->getQueryBuilderMock()) );
        
        $this->assertTrue( $this->languagesSetupManager->getLanguagesSetup() instanceof LanguagesSetup);
    }

    public function testSetIsMultiLanguage()
    {
        $this->languagesSetupManager->setIsMultiLanguage(true);
        
        $this->assertEquals($this->languagesSetupManager->isMultiLanguage(), true);
    }
    
    public function testSetLanguageAbbreviation()
    {
        $this->assertEquals($this->languagesSetupManager->setLanguageAbbreviation('en'), 'en');
    }
    
    public function testGenerateLanguageRecordNoMultiLanguage()
    {
        $this->assertArrayHasKey("languageId", $this->languagesSetupManager->generateLanguageRecord() );
    }
    
    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testGenerateLanguageRecordLanguageSetupException()
    {
        $this->languagesSetupManager->setIsMultiLanguage(true);
        
        $this->languagesSetupManager->generateLanguageRecord();
    }
    
    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testGenerateLanguageRecordLanguageLabelsSetupException()
    {
        $this->languagesSetupManager->setIsMultiLanguage(true);
        $this->languagesSetupManager->setLanguagesSetup( new LanguagesSetup($this->getQueryBuilderMock()) );
        $this->languagesSetupManager->generateLanguageRecord();
    }
    
    public function testGenerateLanguageRecordMultiLanguage()
    {
        $this->languagesSetupManager->setIsMultiLanguage(true);
        $this->languagesSetupManager->setLanguagesSetup( new LanguagesSetup($this->getQueryBuilderMock()) );
        $this->languagesSetupManager->setLanguagesLabelsSetup( new LanguagesLabelsSetup($this->getQueryBuilderMock()) );
        
        $languageRecord = $this->languagesSetupManager->generateLanguageRecord();
        
        $this->assertArrayHasKey("availableLanguages",  $languageRecord);
        $this->assertArrayHasKey("defaultLanguage",     $languageRecord);
        $this->assertArrayHasKey("languageId",          $languageRecord);
        $this->assertArrayHasKey("languagesLabels",     $languageRecord);
    }
}