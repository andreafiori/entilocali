<?php

namespace Admin\Controller\HomePage;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\HomePage\HomePageControllerHelper;
use ModelModule\Model\HomePage\HomePageFreeTextForm;
use ModelModule\Model\HomePage\HomePageGetter;
use ModelModule\Model\HomePage\HomePageGetterWrapper;

/**
 * HomePage Free Text Form
 */
class HomePageFreeTextFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');
        $languageselection = $this->params()->fromRoute('languageselection');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new HomePageControllerHelper();
        $records = $helper->recoverWrapperRecords(
            new HomePageGetterWrapper(new HomePageGetter($em)),
            array(
                'languageAbbreviation'  => $languageselection,
                'id'                    => $id,
            )
        );

        $form = new HomePageFreeTextForm();

        if (!empty($records)) {
            $form->setData($records[0]);

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
                'formBreadCrumbCategory'        => 'Gestione home page',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/homepage-management', array(
                    'lang' => $lang
                )),
                'templatePartial'               => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}