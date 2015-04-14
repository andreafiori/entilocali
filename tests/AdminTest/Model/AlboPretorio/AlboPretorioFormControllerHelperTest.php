<?php

namespace AdminTest\Model\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Admin\Model\AlboPretorio\AlboPretorioFormControllerHelper;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use ApplicationTest\TestSuite;

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

    public function testRecoverAlboArticolo()
    {
        $records = $this->alboPretorioFormControllerHelper->recoverAlboArticolo(

            new AlboPretorioArticoliGetterWrapper(
                new AlboPretorioArticoliGetter( $this->getEntityManagerMock() )
            ),

            1
        );

        $this->assertTrue( is_array($records) );
    }

    public function testRecoverUsersRecords()
    {
        $records = $this->alboPretorioFormControllerHelper->recoverUsersRecords(

            new UsersGetterWrapper(
                new UsersGetter( $this->getEntityManagerMock() )
            ),

            1
        );

        $this->assertTrue( is_array($records) );
    }

    public function testRecoverSezioniRecords()
    {
        $records = $this->alboPretorioFormControllerHelper->recoverSezioniRecords(

            new AlboPretorioSezioniGetterWrapper(
                new AlboPretorioSezioniGetter( $this->getEntityManagerMock() )
            ),

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
     * @expectedException \Application\Model\NullException
     */
    public function testCheckSezioniIsNotEmptyThrowsException()
    {
        $this->alboPretorioFormControllerHelper->checkSezioniIsNotEmpty(array());
    }

    /**
     * @expectedException \Application\Model\NullException
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
