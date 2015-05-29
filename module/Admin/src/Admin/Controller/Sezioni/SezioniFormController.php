<?php

namespace Admin\Controller\Sezioni;

use Admin\Model\Sezioni\SezioniForm;
use Admin\Model\Sezioni\SezioniGetter;
use Admin\Model\Sezioni\SezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class SezioniFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        if (is_numeric($id)) {
            $wrapper = new SezioniGetterWrapper(
                new SezioniGetter($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'))
            );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            $recordFromDb =  $wrapper->getRecords();
        }

        $form = new SezioniForm();
        $form->addLingue(array());
        $form->addOptions();

        if (!empty($recordFromDb)) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = $recordFromDb[0]['nome'];
            $formAction = $this->url()->fromRoute('admin/sezioni-update', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
            ));
        } else {
            $form->setData( array('posizione' => 1) );

            $formTitle = 'Nuova sezione';
            $submitButtonValue = 'Inserisci';
            $formAction = $this->url()->fromRoute('admin/sezioni-insert', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
            ));
        }

        $this->layout()->setVariables(array(
            'form'                          => $form,
            'formAction'                    => $formAction,
            'formTitle'                     => $formTitle,
            'formDescription'               => 'Le sezioni rappresentano i blocchi principali sui quali costruire le basi dei contenuti',
            'submitButtonValue'             => $submitButtonValue,
            'noFormActionPrefix'            => 1,
            'formBreadCrumbCategory'        => 'Sezioni',
            'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/sezioni-summary', array(
                'lang' => 'it',
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
            )),
            'templatePartial' => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}