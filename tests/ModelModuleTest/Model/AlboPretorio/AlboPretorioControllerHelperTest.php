<?php

namespace ModelModuleTest\Model\AlboPretorio;

use ModelModule\Model\NullException;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliFormInputFilter;
use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use ModelModuleTest\TestSuite;

class AlboPretorioControllerHelperTest extends TestSuite
{
    /**
     * @var AlboPretorioControllerHelper
     */
    private $helper;

    private $formDataSample;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->helper = new AlboPretorioControllerHelper();
    }
    
    public function testInsert()
    {
        $this->helper->setConnection($this->getConnectionMock());
        $this->helper->setLoggedUser($this->recoverUserDetails());

        $this->assertEquals(
            $this->helper->insert(new AlboPretorioArticoliFormInputFilter()),
            1
        );
    }

    public function testUpdate()
    {
        $this->helper->setConnection($this->getConnectionMock());
        $this->helper->setLoggedUser($this->recoverUserDetails());

        $this->assertEquals(
            $this->helper->update(new AlboPretorioArticoliFormInputFilter()),
            1
        );
    }

    public function testDelete()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->assertEquals(
            $this->helper->delete(1),
            1
        );
    }

    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testCheckArticoloIsNotAnnulledThrowsException()
    {
        $this->helper->checkArticoloIsNotAnnulled(array(
            array(
                'titolo'    => 'My atto test',
                'annullato' => 1,
            )
        ));
    }

    public function testPublishArticle()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->assertEquals(
            $this->helper->publishArticle(1, 1),
            1
        );
    }
}
