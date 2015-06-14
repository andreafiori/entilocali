<?php

namespace Admin\Controller\StatoCivile;

use ModelModule\Model\StatoCivile\StatoCivileControllerHelper;
use ModelModule\Model\StatoCivile\StatoCivileForm;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetter;
use ModelModule\Model\StatoCivile\Sezioni\StatoCivileSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class StatoCivileFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {
            $helper = new StatoCivileControllerHelper();
            $sezioniRecords = $helper->recoverWrapperRecords(
                new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($em) ),
                array('orderBy' => '')
            );
            $helper->checkRecords($sezioniRecords, 'Nessuna sezione presente');
            $sezioniForDropDown = $helper->formatForDropwdown($sezioniRecords, 'id', 'nome');
            $records = $helper->recoverWrapperRecordsById(
                new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
                array('id' => $id, 'limit' => 1),
                $id
            );

            $form = new StatoCivileForm();
            $form->addSezioni($sezioniForDropDown);
            $form->addDates();

            if ( empty($records) ) {
                $form->setData(array(
                    'data'                  => date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s"). ' + 8 days')),
                    'scadenza'              => date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s"). ' + 8 days')),
                    'numero_progressivo'    => '',
                ));

                $formAction = $this->url()->fromRoute('admin/stato-civile-insert', array(
                    'lang' => $this->params()->fromRoute('lang')
                ));
                $formTitle = 'Nuovo atto stato civile';

            } else {
                $form->setData($records[0]);

                $formAction = $this->url()->fromRoute('admin/stato-civile-update', array(
                    'lang' => $this->params()->fromRoute('lang')
                ));
                $formTitle = 'Modifica atto';
            }

            $this->layout()->setVariables(array(
                    'form'                          => $form,
                    'formTitle'                     => $formTitle,
                    'formDescription'               => '&Egrave; consigliabile inserire <strong>testi brevi sul tema trattato</strong>, possibilmente in minuscolo e con solo la prima iniziale maiuscola',
                    'formAction'                    => $formAction,
                    'formBreadCrumbCategory'        => 'Stato civile',
                    'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/stato-civile-summary', array(
                        'lang' => $this->params()->fromRoute('lang')
                    )),
                    'templatePartial'               => self::formTemplate,
                )
            );

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                'messageType'       => 'danger',
                'messageTitle'      => 'Errore verificato',
                'messageText'       => $e->getMessage(),
                'templatePartial'   => 'message.phtml',
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}