<?php

namespace AdminTest\Controller\Tickets;

use Admin\Controller\Tickets\TicketsInsertController;
use ModelModule\Model\Tickets\TicketsForm;
use ModelModule\Model\Tickets\TicketsFormInputFilter;
use ModelModuleTest\InsertUpdateTestSuite;

class TicketsInsertControllerTest extends InsertUpdateTestSuite
{
    /**
     * @var TicketsInsertController
     */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new TicketsInsertController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'subject'   => 'My subjec test',
            'message'   => 'my ticket message test',
            'priority'  => 'alta',
        );
    }

    public function testFormSampleDataIsNotValid()
    {
        unset($this->formDataSample['subject']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse($form->isValid());
    }

    /**
     * @param array $formDataSample
     * @return TicketsForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new TicketsForm();

        $inputFilter = new TicketsFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
