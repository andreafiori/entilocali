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
            $formAction = 'sezioni-contenuti/update/';
        } else {
            $form->setData( array(
                    'posizione' => 1,
                )
            );

            $formTitle = 'Nuova sezione';
            $submitButtonValue = 'Inserisci';
            $formAction = 'sezioni-contenuti/insert/';
        }

        $this->layout()->setVariables( array(
                'form'                          => $form,
                'formAction'                    => $formAction,
                'formTitle'                     => $formTitle,
                'formDescription'               => 'Le sezioni rappresentano i blocchi principali sui quali costruire le basi dei contenuti',
                'submitButtonValue'             => $submitButtonValue,
                'formBreadCrumbCategory'        => 'Sezioni',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/sezioni-summary', array('lang' => 'it')),
                'templatePartial'               => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}