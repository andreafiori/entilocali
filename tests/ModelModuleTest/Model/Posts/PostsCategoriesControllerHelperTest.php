<?php

namespace ModelModuleTest\Model\Posts;

use ModelModule\Model\Posts\PostsCategoriesControllerHelper;
use ModelModuleTest\TestSuite;

class PostsCategoriesControllerHelperTest extends TestSuite
{
    /**
     * @var PostsCategoriesControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new PostsCategoriesControllerHelper();
    }

    public function testRecoverLabelByModuleCode()
    {
        $this->assertEquals($this->helper->recoverLabelByModuleCode('blogs'), 'Blogs', 'Blogs must be referred to blogs module');
        $this->assertEquals($this->helper->recoverLabelByModuleCode('videos'), 'Videos', 'Videos must be referred to videos module');
        $this->assertEquals($this->helper->recoverLabelByModuleCode('photo'), 'Foto', 'Foto must be referred to photo module');
        $this->assertEquals($this->helper->recoverLabelByModuleCode('contents'), 'Contenuti', 'Contenuti must be referred to contents module');
    }

    /**
     * @expectedException \Exception
     */
    public function testRecoverLabelByModuleCodeThrowsException()
    {
        $this->helper->recoverLabelByModuleCode('nopostmodulecode');
    }

    public function testRecoverRouteByModuleCode()
    {
        $this->assertEquals($this->helper->recoverRouteByModuleCode('blogs'), 'admin/blogs-summary');
        $this->assertEquals($this->helper->recoverRouteByModuleCode('photo'), 'admin/photo-summary');
        $this->assertEquals($this->helper->recoverRouteByModuleCode('contents'), 'admin/contents-summary');
        $this->assertEquals($this->helper->recoverRouteByModuleCode('videos'), 'admin/videos-summary');
    }

    /**
     * @expectedException \Exception
     */
    public function testRecoverRouteByModuleCodeThrowsException()
    {
        $this->helper->recoverRouteByModuleCode('nopostmodulecode');
    }
}
