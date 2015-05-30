<?php

namespace ApplicationTest\Model\RouterManagers;

use ModelModuleTest\TestSuite;

class RouterManagerAbstractTest extends TestSuite
{
    /**
     * @var \ModelModule\Model\RouterManagers\RouterManagerAbstract
     */
    private $routerManagerAbstract;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->routerManagerAbstract = $this->getMockForAbstractClass(
            'ModelModule\Model\RouterManagers\RouterManagerAbstract'
        );
        
        $this->routerManagerAbstract->setInput(array(
            'serviceLocator'        => $this->serviceManager,
            'entityManager'         => $this->getEntityManagerMock(),
            'queryBuilder'          => $this->getQueryBuilderMock(),
            
            'languageId'            => 1,
            'languageAbbreviation'  => 'it',
            'channelId'             => 1,
            
            'posts_titolo'          => 'My Title',
            'posts_nome_categoria'  => 'My Category Name',
        ));
        
        $this->routerManagerAbstract->setRouter(array(
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
        $this->assertTrue( is_array($this->routerManagerAbstract->getInput()) );
        $this->assertTrue( is_object($this->routerManagerAbstract->getInput('serviceLocator')) );
    }
    
    public function testSetRouter()
    {
        $this->assertTrue( is_array($this->routerManagerAbstract->getRouter()) );
        $this->assertTrue( is_string($this->routerManagerAbstract->getRouter('default')) );
    }
    
    public function testSetRecords()
    {
        $recordsForTest = array( array("id"=>1,"title"=>"my title") );
        
        $this->routerManagerAbstract->setRecords($recordsForTest);
        
        $this->assertEquals($this->routerManagerAbstract->getRecords(), $recordsForTest);
    }
    
    public function testSetOutputExportArrayElement()
    {
        $this->routerManagerAbstract->setVariable('myKey', 'myValue');
        
        $output = $this->routerManagerAbstract->getOutput();
        
        $this->assertEquals($output['export']['myKey'], 'myValue');
    }
}
