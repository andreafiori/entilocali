<?php

namespace ApiWebService\Model;

use ApplicationTest\TestSuite;
use ApiWebService\Model\ApiSetup;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class ApiSetupTest extends TestSuite
{
    private $apiSetup;
    
    private $validInputSample, $resouceClassMapSample;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->apiSetup = new ApiSetup();
        
        $this->validInputSample = array(
            'key'       => 'myApiKey',
            'username'  => 'myUsername',
            'password'  => 'myPassword'
        );
        
        $this->resouceClassMapSample = array(
            'contents'  => 'ApiWebService\Model\Resources\PostsApiResource',
            'blogs'     => 'ClassDoesntExist'
        );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetupAuthenticationInputThrowsException()
    {
        $this->apiSetup->setupAuthenticationInput();
        
        $this->assertInstanceOf('\Zend\Http\Response', $this->apiSetup->getResponseToReturn());
    }
    
    public function testSetupAuthenticationInput()
    {
        $this->apiSetup->setInput($this->validInputSample);
        
        $this->apiSetup->setupAuthenticationInput();
        
        $this->assertTrue( is_array($this->apiSetup->getAuthenticationInput()) );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
	 /*
    public function testValidateAuthenticationInputThrowsException()
    {
        $this->apiSetup->setInput(array('unuselessKey'=>'noGoValue'));
        
        $this->apiSetup->setupAuthenticationInput();
    }
	*/
	
    /**
     * @expectedException \Application\Model\NullException
     */
	 /*
    public function testValidateAuthenticationInputThrowsSecondException()
    {
        $this->apiSetup->setInput(array('username' => 'myUsername'));
        
        $this->apiSetup->setupAuthenticationInput();
    }
	
    
    public function testSetEntityManager()
    {
        $this->apiSetup->setEntityManager($this->getEntityManagerMock());
        
        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $this->apiSetup->getEntityManager());
    }
    
	
    public function testSetUsersGetterWrapper()
    {
        $this->apiSetup->setUsersGetterWrapper(
            new UsersGetterWrapper( new UsersGetter($this->getEntityManagerMock()) )
        );
        
        $this->assertInstanceOf('Admin\Model\Users\UsersGetterWrapper', $this->apiSetup->getUsersGetterWrapper());
    }
    */
	
    /*
    public function testAuthenticate()
    {
        $this->apiSetup->setUsersGetterWrapper( new UsersGetterWrapper(new UsersGetter($this->getEntityManagerMock()) ) );
        $this->apiSetup->authenticate($this->authenticationInput);
    }
    
    
    public function testSetResourceClassName()
    {
        $this->apiSetup->setResourceClassMap($this->resouceClassMapSample);
        
        $this->apiSetup->setResourceClassName('contents');
        
        $this->assertNotEmpty($this->apiSetup->getResourceClassName());
    }
    
	
    public function testSetResourceClassMap()
    {
        $this->apiSetup->setResourceClassMap($this->resouceClassMapSample);
        
        $this->assertTrue( is_array($this->apiSetup->getResourceClassMap()) );
    }
    */
	
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetInvalidResource()
    {
        $this->apiSetup->setResourceClassName('invalid-resource');
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetInvalidResourceWithNonExistentClass()
    {
        $this->apiSetup->setResourceClassMap( $this->resouceClassMapSample );
        
        $this->apiSetup->setResourceClassName('blogs');
    }
}
