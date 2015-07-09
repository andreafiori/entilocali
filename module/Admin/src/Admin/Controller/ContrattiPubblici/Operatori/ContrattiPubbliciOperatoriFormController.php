<?php

namespace Admin\Controller\ContrattiPubblici\Operatori;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriForm;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetter;
use ModelModule\Model\ContrattiPubblici\Operatori\OperatoriGetterWrapper;

class ContrattiPubbliciOperatoriFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id         = $this->params()->fromRoute('id');
        $lang       = $this->params()->fromRoute('lang');

        $helper = new ContrattiPubbliciControllerHelper();
        $operatoriRecords = $helper->recoverWrapperRecordsById(
            new OperatoriGetterWrapper(new OperatoriGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );

        $form = new OperatoriForm();

        if ($operatoriRecords) {
            $form->setData($operatoriRecords[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = $operatoriRecords[0]['nome'];
            $formAction = $this->url()->fromRoute('admin/contratti-pubblici-operatori-update', array(
                'lang'  => $lang,
            ));
        } else {
            $formTitle = 'Nuova azienda';
            $submitButtonValue = 'Inserisci';
            $formAction = $this->url()->fromRoute('admin/contratti-pubblici-operatori-insert', array(
                'lang'  => $lang,
            ));
        }

        $this->layout()->setVariables( array(
                'form'                   => $form,
                'formAction'             => $formAction,
                'formTitle'              => $formTitle,
                'formDescription'        => 'Compila dati operatore abilitato a partecipare ai bandi di gara e contratti pubblici',
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => array(
                    array(
                        'label' => 'Contratti pubblici',
                        'href' => $this->url()->fromRoute('admin/contratti-pubblici-summary', array(
                            'lang'  => $lang,
                        )),
                        'title' => 'Elenco contratti pubblici'
                    ),
                    array(
                        'label' => 'Aziende',
                        'href' => $this->url()->fromRoute('admin/contratti-pubblici-operatori-summary', array(
                            'lang'  => $lang,
                        )),
                        'title' => 'Elenco aziende'
                    )
                ),
                'templatePartial' => self::formTemplate,
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}