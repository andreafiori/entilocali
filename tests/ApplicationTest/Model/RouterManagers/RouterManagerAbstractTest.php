<?php

namespace ApplicationTest\Model;

use ApplicationTest\TestSuite;

/**
 * Frontend Router Abstract for the Index Controller
 * 
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class FrontendRouterAbstractTest extends TestSuite
{
    private $frontendRouter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->frontendRouter = $this->getMockForAbstractClass('Application\Model\FrontendHelpers\FrontendRouterAbstract');
        
        $this->frontendRouter->setInput(array(
            'serviceLocator'        => $this->serviceManager,
            'entityManager'         => $this->getEntityManagerMock(),
            'queryBuilder'          => $this->getQueryBuilderMock(),
            
            'languageId'            => 1,
            'languageAbbreviation'  => 'it',
            'channelId'             => 1,
            
            'posts_titolo'          => 'My Title',
            'posts_nome_categoria'  => 'My Category Name',
        ));
        
        $this->frontendRouter->setRouter(array(
            "default"                       => 'Application\Model\Posts\PostsFrontend',
            "foto"                          => 'Application\Model\Posts\FotoFrontend',
            "albo-pretorio"                 => 'Application\Model\AlboPretorio\AlboPretorioFrontend',
            "stato-civile"                  => 'Application\Model\StatoCivile\StatoCivileFrontend',
            "amministrazione-aperta"        => 'Application\Model\AmministrazioneAperta\AmministrazioneApertaFrontend',
            "amministrazione-trasparente"   => 'Application\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteFrontend',
            "contatti"                      => 'Application\Model\Contacts\ContactsFrontend',
        ));
    }
    
    public function testSetInput()
    {
        $this->assertTrue( is_array($this->frontendRouter->getInput()) );
        $this->assertTrue( is_object($this->frontendRouter->getInput('serviceLocator')) );
    }
    
    public function testSetRouter()
    {
        $this->assertTrue( is_array($this->frontendRouter->getRouter()) );
        $this->assertTrue( is_string($this->frontendRouter->getRouter('default')) );
    }
    
    public function testSetRecords()
    {
        $recordsForTest = array( array("id"=>1,"title"=>"my title") );
        
        $this->frontendRouter->setRecords($recordsForTest);
        
        $this->assertEquals($this->frontendRouter->getRecords(), $recordsForTest);
    }
    
    public function testSetOutputExportArrayElement()
    {
        $this->frontendRouter->setFrontendVariable('myKey', 'myValue');
        
        $output = $this->frontendRouter->getOutput();
        
        $this->assertEquals($output['export']['myKey'], 'myValue');
    }
}
