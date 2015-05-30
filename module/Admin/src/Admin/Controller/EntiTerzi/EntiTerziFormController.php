<?php

namespace Admin\Controller\EntiTerzi;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\EntiTerzi\EntiTerziForm;
use ModelModule\Model\EntiTerzi\EntiTerziGetter;
use ModelModule\Model\EntiTerzi\EntiTerziGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  08 April 2015
 */
class EntiTerziFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        if (is_numeric($id)) {
            $wrapper = new EntiTerziGetterWrapper(
                new EntiTerziGetter($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'))
            );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            $recordFromDb = $wrapper->getRecords();
        }

        $form = new EntiTerziForm();
        if (!empty($recordFromDb)) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue  = 'Modifica';
            $formTitle          = 'Modifica ente terzo';
            $formAction         = 'enti-terzi/update/';
        } else {
            $formTitle          = 'Nuovo ente terzo';
            $submitButtonValue  = 'Inserisci';
            $formAction         = 'enti-terzi/insert/';
        }

        $this->layout()->setVariables( array(
                'formTitle'                     => $formTitle,
                'formDescription'               => "Compila i dati relativi a all'ente terzo",
                'form'                          => $form,
                'formAction'                    => $formAction,
                'submitButtonValue'             => $submitButtonValue,
                'formBreadCrumbCategory'        => 'Enti terzi',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/enti-terzi-summary', array(
                    'lang' => $this->params()->fromRoute('lang')
                )),
                'templatePartial'               => 'formdata/formdata.phtml'
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}