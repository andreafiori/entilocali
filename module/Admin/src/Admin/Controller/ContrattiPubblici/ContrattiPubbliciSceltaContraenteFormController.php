<?php

namespace Admin\Controller\ContrattiPubblici;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteForm;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;

class ContrattiPubbliciSceltaContraenteFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $id = $this->params()->fromRoute('id');

        $helper = new ContrattiPubbliciControllerHelper();
        $recordFromDb = $helper->recoverWrapperRecordsById(
            new SceltaContraenteGetterWrapper(new SceltaContraenteGetter($em)),
            array('csc.id' => $id, 'limit' => 1),
            $id
        );


        $form = new SceltaContraenteForm();

        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);

            $formAction             = 'contratti-pubblici-scelta-contraente/update';
            $formTitle              = 'Modifica voce scelta del contraente';
            $formDescription        = 'Modifica scelta contraente';
            $formBreadCrumbTitle    = 'Modifica';
        } else {
            $formAction             = 'contratti-pubblici-scelta-contraente/insert';
            $formTitle              = 'Nuova voce scelta del contraente';
            $formDescription        = 'Inserisci voce scelta contraente';
            $formBreadCrumbTitle    = 'Nuova';
        }

        $this->layout()->setVariables( array(
                'form'                   => $form,
                'formAction'             => $formAction,
                'formTitle'              => $formTitle,
                'formDescription'        => $formDescription,
                'submitButtonValue'      => 'Conferma',
                'formBreadCrumbTitle'   => $formBreadCrumbTitle,
                'formBreadCrumbCategory' => array(
                    array(
                        'href' =>   $this->url()->fromRoute('admin/contratti-pubblici-summary', array(
                            'lang' => $this->params()->fromRoute('lang')
                        )),
                        'title' => 'Elenco contratti pubblici',
                        'label' => 'Contratti pubblici'
                    ),
                    array(
                        'href' =>   $this->url()->fromRoute(
                            'admin/contratti-pubblici-scelta-contraente-summary',
                            array('lang' => $this->params()->fromRoute('lang'))
                        ),
                        'title' => 'Elenco voci scelta contraente',
                        'label' => 'Scelta contraente'
                    )
                ),
                'templatePartial' => self::formTemplate
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}