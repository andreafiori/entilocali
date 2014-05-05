<?php

namespace Application\Model;

use ApplicationTest\TestSuite;
use Application\Model\Frontend\FrontendRouter;

use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsFrontend
{
    protected $input;
    
    /**
     * Generate main array record for the index frontend controller
     * 
     * @return type
     */
    public function setupFrontendRecord()
    {
        $input = $this->getInput();
        if ( empty($input) ) {
            return array(
               'templatePartial' => 'homepage.phtml'
           );
        }

        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getInput('entityManager')) );
        $postsGetterWrapper->setInput($input);
        
        $output = array();
        $output['mainControllerResponse'] = $postsGetterWrapper->getRecords();

        if ( isset($output['mainControllerResponse']['template']) ) {
            $output['templatePartial'] = $output['mainControllerResponse']['template'];
        }
        
        return $output;
    }
    
    public function setInput(array $input)
    {
        $this->input = $input;
    }
    
    public function getInput($key=null)
    {
        if ( isset($this->input[$key]) ) {
            return $this->input[$key];
        }
        
        return $this->input;
    }
}

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class FrontendRouterTest extends TestSuite
{
    private $frontendRouter;
    
    private $input;
    private $router;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->frontendRouter = new FrontendRouter();
        
        $this->input = array(
            'serviceLocator'  => $this->serviceManager,
            'entityManager'   => $this->getEntityManagerMock(),
            'queryBuilder'    => $this->getQueryBuilderMock(),
            
            'languageId'            => 1,
            'languageAbbreviation'  => 'it',
            'channelId'             => 1,
            
            'posts_titolo'          => 'My Title',
            'posts_nome_categoria'  => 'My Category Name',
        );
        $this->frontendRouter->setInput($this->input);
        
        // route => class to use
        $this->router = array(
            "deafult"                => 'PostsFrontend',
            "foto"                   => 'FotoFrontend',
            "albo-pretorio"          => 'AlboPretorioFrontend',
            "amministrazione-aperta" => 'AmministrazioneApertaFrontend',
        );
    }
    
    public function testSetInput()
    {
        $this->assertTrue( is_array($this->frontendRouter->getInput()) );
        $this->assertTrue( is_object($this->frontendRouter->getInput('serviceLocator')) );
    }
    
    public function testSetRouter()
    {
        $this->frontendRouter->setRouter($this->router);
        
        $this->assertTrue( is_array($this->frontendRouter->getRouter()) );
        $this->assertTrue( is_string($this->frontendRouter->getRouter('deafult')) );
    }
    
    public function testDefaultRoute()
    {
        $input = $this->frontendRouter->getInput();
        
        $postsFrontend = new PostsFrontend();
        $postsFrontend->setInput($input);

        $this->assertTrue( is_array($postsFrontend->setupFrontendRecord()) );
    }
}
