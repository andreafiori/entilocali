<?php

namespace AdminTest\Model\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioOperationsControllerHelper;

/**
 * @author Andrea Fiori
 * @since  14 April 2015
 */
class AlboPretorioOperationsControllerHelperTest extends TestSuite
{
    /**
     * @var AlboPretorioOperationsControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new AlboPretorioOperationsControllerHelper();
    }

    public function testRecoverSingleArticle()
    {
        $article = $this->helper->recoverSingleArticle(
            new AlboPretorioArticoliGetterWrapper( new AlboPretorioArticoliGetter($this->getEntityManagerMock())),
            1
        );

        $this->assertTrue( is_array($article) );
    }

    public function testPublishArticle()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->assertTrue( $this->helper->publishArticle(12) );
    }

    public function testAnnullArticle()
    {
        $this->helper->setConnection($this->getConnectionMock());

        $this->assertTrue( $this->helper->annullArticle(12) );
    }
}