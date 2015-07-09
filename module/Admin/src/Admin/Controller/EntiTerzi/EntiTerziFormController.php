<?php

namespace Admin\Controller\EntiTerzi;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\EntiTerzi\EntiTerziForm;
use ModelModule\Model\EntiTerzi\EntiTerziGetter;
use ModelModule\Model\EntiTerzi\EntiTerziGetterWrapper;
use ModelModule\Model\EntiTerzi\EntiTerziControllerHelper;

class EntiTerziFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new EntiTerziControllerHelper();
        $entiTerziRecords = $helper->recoverWrapperRecordsById(
            new EntiTerziGetterWrapper(new EntiTerziGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );

        $form = new EntiTerziForm();

        if (!empty($entiTerziRecords)) {
            $form->setData($entiTerziRecords[0]);

            $submitButtonValue  = 'Modifica';
            $formTitle          = 'Modifica ente terzo';
            $formAction         =  $this->url()->fromRoute('admin/enti-terzi-update', array(
                'lang' => $lang
            ));
        } else {
            $formTitle          = 'Nuovo ente terzo';
            $submitButtonValue  = 'Inserisci';
            $formAction         = $this->url()->fromRoute('admin/enti-terzi-insert', array(
                'lang' => $lang
            ));
        }

        $this->layout()->setVariables( array(
                'formTitle'                     => $formTitle,
                'formDescription'               => "Compila i dati relativi a all'ente terzo",
                'form'                          => $form,
                'formAction'                    => $formAction,
                'submitButtonValue'             => $submitButtonValue,
                'formBreadCrumbCategory'        => 'Enti terzi',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/enti-terzi-summary', array(
                    'lang' => $lang
                )),
                'templatePartial'               => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}