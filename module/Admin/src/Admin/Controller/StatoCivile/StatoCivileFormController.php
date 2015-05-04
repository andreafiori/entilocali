<?php

namespace Admin\Controller\StatoCivile;

use Admin\Model\StatoCivile\StatoCivileForm;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Admin\Model\StatoCivile\StatoCivileSezioniGetter;
use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class StatoCivileFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $sezioniWrapper = new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($em) );
        $sezioniWrapper->setInput(array(

        ));
        $sezioniWrapper->setupQueryBuilder();

        $sezioniRecords = $sezioniWrapper->getRecords();

        if (empty($sezioniRecords)) {

            $this->setVariables(array(
                'messageType'       => 'warning',
                'messageTitle'      => 'Nessuna sezione presente',
                'messageText'       => "Non &egrave; possibile inserire un nuovo articolo se non esiste almeno una sezione.",
                'templatePartial'   => 'message.phtml',
            ));

            $this->layout()->setTemplate($mainLayout);
            return;
        }

        $sezioniFormatted = array();
        foreach($sezioniRecords as $sezione) {
            if (isset( $sezione['nome'])) {
                $sezioniFormatted[$sezione['id']] = $sezione['nome'];
            }
        }

        $form = new StatoCivileForm();
        $form->addSezioni($sezioniFormatted);
        $form->addDates();
        $form->addId();

        if (is_numeric($id)) {
            $wrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($em) );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();
        }

        if ( empty($records) ) {
            $form->setData(array(
                'scadenza'=> date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s"). ' + 8 days')),
            ));

            $formAction = 'stato-civile/update/';

            $formTitle = 'Nuovo atto stato civile';
        } else {
            $form->setData($records[0]);

            $formAction = 'stato-civile/insert/';
            $formTitle = 'Modifica atto';
        }

        $this->layout()->setVariables(array(
                'form'                          => $form,
                'formTitle'                     => $formTitle,
                'formDescription'               => '&Egrave; consigliabile inserire testi brevi sul tema trattato, possibilmente in minuscolo',
                'formAction'                    => $formAction,
                'formBreadCrumbCategory'        => 'Stato civile',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/stato-civile-summary', array(
                        'lang' => 'it'
                    )
                ),
                'templatePartial'               => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}