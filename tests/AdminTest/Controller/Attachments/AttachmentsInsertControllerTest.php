<?php

namespace AdminTest\Controller\Attachments;

use Admin\Controller\Attachments\AttachmentsInsertController;
use ModelModule\Model\Attachments\AttachmentsForm;
use ModelModule\Model\Attachments\AttachmentsFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;
use Zend\InputFilter\FileInput;

class AttachmentsInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var AttachmentsInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new AttachmentsInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $upload = new \Zend\Stdlib\Parameters([
            'attachmentFile' => [
                'name' => 'blah.blah',
                'type' => 'blah',
                'tmp_name' => 'tmp/file',
                'error' => 0
            ]
        ]);
        $this->request->setFiles($upload);

        $this->formDataSample = array(
            current($this->request->getFiles()->toArray()),
            'title'             => 'my file title',
            'description'       => 'my file description',
            'expireDate'        => '2015-01-01 01:00:00',
            's3_directory'      => 'subdirectory',
            'moduleId'          => 2,
            'attachmenOptionId' => 2,
            'referenceId'       => 2,
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['attachmentFile']);
        unset($this->formDataSample['title']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    protected function setupForm($formDataSample)
    {
        $form = new AttachmentsForm();
        $form->addInputFile();
        $form->addSecondaryFields();

        $inputFilter = new AttachmentsFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}