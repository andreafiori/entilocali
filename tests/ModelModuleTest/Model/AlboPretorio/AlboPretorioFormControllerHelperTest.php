<?php

namespace ModelModuleTest\Model\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioFormControllerHelper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use ModelModule\Model\Users\UsersGetter;
use ModelModule\Model\Users\UsersGetterWrapper;
use ModelModuleTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  09 April 2015
 */
class AlboPretorioFormControllerHelperTest extends TestSuite
{
    /**
     * @var AlboPretorioFormControllerHelper
     */
    private $alboPretorioFormControllerHelper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->alboPretorioFormControllerHelper = new AlboPretorioFormControllerHelper();
    }

    public function testSetupAlboArticolo()
    {
        $records = $this->alboPretorioFormControllerHelper->setupAlboArticolo(
            new AlboPretorioArticoliGetterWrapper( new AlboPretorioArticoliGetter( $this->getEntityManagerMock() )  ),
            1
        );

        $this->assertTrue( is_array($records) );
    }

    public function testRecoverUsersRecords()
    {
        $records = $this->alboPretorioFormControllerHelper->recoverUsersRecords(
            new UsersGetterWrapper( new UsersGetter($this->getEntityManagerMock()) ),
            1
        );

        $this->assertTrue( is_array($records) );
    }

    public function testRecoverSezioniRecords()
    {
        $records = $this->alboPretorioFormControllerHelper->recoverSezioniRecords(
            new AlboPretorioSezioniGetterWrapper( new AlboPretorioSezioniGetter($this->getEntityManagerMock()) ),
            1
        );

        $this->assertTrue( is_array($records) );
    }

    public function testFormatSezioniForADropdown()
    {
        $records = array(
            array(
                'id' => 1,
                'nome' => 'Sezione 1'
            ),
            array(
                'id'    => 2,
                'nome'  => 'Sezione 2',
            ),
        );

        $this->assertTrue( is_array($this->alboPretorioFormControllerHelper->formatSezioniForADropdown($records)) );
    }

    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testCheckSezioniIsNotEmptyThrowsException()
    {
        $this->alboPretorioFormControllerHelper->checkSezioniIsNotEmpty(array());
    }

    /**
     * @expectedException \ModelModule\Model\NullException
     */
    public function testCheckArticoloIsNotAnnullThrowsException()
    {
        $this->alboPretorioFormControllerHelper->checkArticoloIsNotAnnull(array(
            array(
                'titolo'    => 'Albo Articolo',
                'annullato' => 1,
            )
        ));
    }
}
