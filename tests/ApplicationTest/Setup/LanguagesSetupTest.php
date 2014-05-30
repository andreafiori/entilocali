<?php

namespace ApplicationTest\Setup;

use ApplicationTest\TestSuite;
use Application\Setup\LanguagesSetup;

/**
 * @author Andrea Fiori
 * @since 26 April 2014
 */
class LanguagesSetupTest extends TestSuite
{
    private $languagesSetup;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->languagesSetup = new LanguagesSetup( $this->getQueryBuilderMock() );
    }
    
    public function testSetAllAvailableLanguages()
    {
        $this->assertTrue( is_array($this->languagesSetup->setAllAvailableLanguages(1)) );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetDefaultLanguageException()
    {
        $this->languagesSetup->setDefaultLanguage('it');
    }
    
    public function testSetDefaultLanguage()
    {
        $this->languagesSetup->setAllAvailableLanguages(1);
        
        $this->assertNull( $this->languagesSetup->setDefaultLanguage('it') );
    }
    
    /**
     * @return number $languageId
     */
    public function testSetLanguageId()
    {
        $this->assertEquals($this->languagesSetup->setLanguageId(), 1);
    }
}