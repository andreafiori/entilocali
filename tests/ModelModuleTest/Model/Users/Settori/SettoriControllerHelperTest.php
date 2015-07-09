<?php

namespace ModelModuleTest\Model\Users\Settori;

use ModelModule\Model\Users\Settori\SettoriControllerHelper;
use ModelModule\Model\Users\Settori\UsersSettoriForm;
use ModelModule\Model\Users\Settori\UsersSettoriFormInputFilter;
use ModelModuleTest\TestSuite;

class SettoriControllerHelperTest extends TestSuite
{
    /**
     * @var SettoriControllerHelper
     */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = new SettoriControllerHelper();
    }

    public function testUpdate()
    {
        $form = $this->buildForm();

        $formValidator = new UsersSettoriFormInputFilter();

        $form->setInputFilter( $formValidator->getInputFilter() );

        if ( $form->isValid() ) {
            $formValidator->exchangeArray( $form->getData() );

            $this->helper->setConnection($this->getConnectionMock());

            $this->assertEquals($this->helper->update($formValidator), 1);
        }
    }

    private function buildForm()
    {
        $form = new UsersSettoriForm();
        $form->setBindOnValidate(false);
        $form->addResponsabile(array(
            1 => 'John Doe',
            2 => 'Mike Smith',
        ));
        $form->setData(array(
            'nome'                  => 'Sector name',
            'responsabileUserId'    => 1,
        ));

        return $form;
    }
}
