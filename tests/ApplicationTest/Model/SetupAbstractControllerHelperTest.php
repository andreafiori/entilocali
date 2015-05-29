<?php

namespace ApplicationTest\Model;

use Admin\Service\AppServiceLoader;
use Application\Model\SetupAbstractControllerHelper;
use ApplicationTest\TestSuite;
use Zend\Session\Container as SessionContainer;

class SetupAbstractControllerHelperTest extends TestSuite
{
    /**
     * @var SetupAbstractControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new SetupAbstractControllerHelper(0);
    }

    public function testSetAppServiceLoader()
    {
        $this->helper->setAppServiceLoader(new AppServiceLoader());

        $this->assertInstanceOf(
            '\Admin\Service\AppServiceLoader',
            $this->helper->getAppServiceLoader()
        );
    }

    public function testSetConfigurations()
    {
        $this->helper->setConfigurations(array(
            $this->helper->setConfigurations($this->getFrontendCommonInput())
        ));

        $this->assertTrue( is_array($this->helper->getConfigurations()));
    }

    public function testSetSessionContainer()
    {
        $this->helper->setSessionContainer(new SessionContainer());

        $this->assertInstanceOf(
            '\Zend\Session\Container',
            $this->helper->getSessionContainer()
        );
    }

    public function testSetRequest()
    {
        $this->helper->setRequest('myRequestObject');

        $this->assertNotEmpty( $this->helper->getRequest() );
    }

    public function testSetupSezioniRecords()
    {
        $this->helper->setupSezioniRecords(array(
            array(
                'id'    => 1,
                'nome'  => 'Sezione 1',
            )
        ));

        $this->assertNotEmpty( $this->helper->getSezioniRecords() );
    }

    public function testSetupServer()
    {
        $this->helper->setRequest( new \Zend\Http\PhpEnvironment\Request() );

        $this->assertNotNull( $this->helper->getRequest() );
    }

    public function testSetupPhpRendererIsNull()
    {
        $this->helper->setupPhpRenderer($this->getServiceManager());

        $this->assertNull( $this->helper->getPhpRenderer() );
    }

    public function testSetupZf2appDir()
    {
        $this->helper->setConfigurations(array('sitename' => 'mySitename', 'zf2appDir' => 'demo'));

        $this->helper->setupZf2appDir();

        $this->assertNotEmpty( $this->helper->getZf2appDir() );
    }

    public function testSetupAppDirRelativePathNotOnRoot()
    {
        $this->setupHelperAppDirRelativePath();

        $this->assertTrue( is_string($this->helper->getAppDirRelativePath()) );
    }

    public function testSetupAppDirRelativePathOnRoot()
    {
        $this->setupHelperAppDirRelativePath(1);

        $this->assertTrue( is_string($this->helper->getAppDirRelativePath()) );
    }

    /**
     * @param int $onRoot
     */
    private function setupHelperAppDirRelativePath($onRoot = 0)
    {
        $this->helper->setConfigurations(array(
            'sitename'          => 'mySitename',
            'zf2appDir'         => 'demo',
            'isPublicDirOnRoot' => $onRoot
        ));

        $this->helper->setRequest( new \Zend\Http\PhpEnvironment\Request() );

        $this->helper->setupZf2appDir();

        $this->helper->setupAppDirRelativePath();
    }
}