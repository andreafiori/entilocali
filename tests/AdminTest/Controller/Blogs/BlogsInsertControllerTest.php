<?php

namespace AdminTest\Controller\Blogs;

use Admin\Controller\Blogs\BlogsFormController;
use Admin\Controller\Blogs\BlogsInsertController;
use ModelModule\Model\Posts\PostsForm;
use ModelModule\Model\Posts\PostsFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;
use ModelModuleTest\TestSuite;

class BlogsInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var BlogsInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new BlogsInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $upload = new \Zend\Stdlib\Parameters([
            'image' => [
                'name'      => 'my image',
                'type'      => 'img',
                'tmp_name'  => 'tmp/file',
                'error'     => 0,
            ]
        ]);
        $this->request->setFiles($upload);

        $this->formDataSample = array(
            current($this->request->getFiles()->toArray()),
            'title'         => 'My post title',
            'description'   => 'My post description as a long text',
            'status'        => 1,
            'expireDate'    => '2015-01-01 01:01:00',
            'categories'    => array(1,2,3),
            'moduleId'      => 4,
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['title']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    protected function setupForm($formDataSample)
    {
        $form = new PostsForm();
        $form->addUploadImage();
        $form->addTitle();
        $form->addSubtitle();
        $form->addMainFields();

        $inputFilter = new PostsFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
