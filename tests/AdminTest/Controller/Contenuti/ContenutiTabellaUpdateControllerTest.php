<?php

namespace AdminTest\Controller\Contenuti;

use Admin\Controller\Contenuti\ContenutiTabellaUpdateController;
use ModelModule\Model\Contenuti\ContenutiTabellaForm;
use ModelModule\Model\Contenuti\ContenutiTabellaFormInputFilter;
use ModelModuleTest\TestSuite;

class ContenutiTabellaUpdateControllerTest extends TestSuite
{
    /**
     * @var ContenutiTabellaUpdateController
     */
    protected $controller;

    private $formDataSample;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new ContenutiTabellaUpdateController();
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->getServiceManager());

        $this->formDataSample = array(
            'id'        => 1,
            'titolo'    => 'My Hidden article title',
            'tabella'   => 'My large content table!',
        );
    }

    public function testFormSampleIsNotValid()
    {
        unset($this->formDataSample['titolo']);

        $form = $this->setupForm($this->formDataSample);

        $this->assertFalse( $form->isValid() );
    }

    /**
     * @param array $formDataSample
     * @return ContenutiTabellaForm
     */
    protected function setupForm($formDataSample)
    {
        $form = new ContenutiTabellaForm();

        $inputFilter = new ContenutiTabellaFormInputFilter();

        $form->setInputFilter($inputFilter->getInputFilter());

        $form->setData($formDataSample);

        return $form;
    }
}
