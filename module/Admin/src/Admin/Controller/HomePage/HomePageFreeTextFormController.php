<?php

namespace Admin\Controller\HomePage;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\HomePage\HomePageControllerHelper;
use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;

class HomePageFreeTextFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new HomePageControllerHelper();
        $entiTerziRecords = $helper->recoverWrapperRecords(
            new HomePageGetterWrapper(new HomePageGetter($em)),
            array(
                'languageAbbreviation' => '',
            )
        );

        $form = new EntiTerziForm();

        if (!empty($entiTerziRecords)) {
            $form->setData($entiTerziRecords[0]);

            $submitButtonValue  = 'Modifica';
            $formTitle          = 'Modifica testo libero';
            $formAction         =  $this->url()->fromRoute('admin/homepage-freetext-update', array(
                'lang' => $lang
            ));
        } else {
            $formTitle          = 'Nuovo testo libero';
            $submitButtonValue  = 'Inserisci';
            $formAction         = $this->url()->fromRoute('admin/homepage-freetext-insert', array(
                'lang' => $lang
            ));
        }

        $this->layout()->setVariables( array(
                'formTitle'                     => $formTitle,
                'formDescription'               => "Compila i dati relativi al testo da inserire in home page",
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