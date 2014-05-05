<?php

namespace ApiWebServiceTest\Model;

use ApplicationTest\TestSuite;
use ApiWebService\Model\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterTest //extends TestSuite
{
    private $postsGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsGetter = new PostsGetter( $this->getEntityManagerMock() );
        $this->postsGetter->setMainQuery();
        $this->postsGetter->setLanguageId();
        $this->postsGetter->setChannelId();
    }
    
    public function testSetId()
    {
        $this->postsGetter->setId(1);
        
        $this->assertTrue( strpos($this->postsGetter->getQuery(), "AND p.id = ")!== false );
    }
    
    public function testSetNomeCategoria()
    {
        $this->postsGetter->setNomeCategoria('MyPostCategory');
        
        $this->assertTrue( strpos($this->postsGetter->getQuery(), "AND co.nome = ")!== false );
    }
       
    public function testSetTitolo()
    {
        $this->postsGetter->setTitolo('MyPostTitle');
        
        $this->assertTrue( strpos($this->postsGetter->getQuery(), "AND po.titolo = ")!== false );
    }
    
    public function testSetTipo()
    {
        $this->postsGetter->setTipo('content');
        
        $this->assertTrue( strpos($this->postsGetter->getQuery(), "AND p.tipo = ")!== false );
    }
    /*
    public function testGetQueryResult()
    {
        $this->assertTrue( is_array( $this->postsGetter->getQueryResult() ) );
    }
    */
}
