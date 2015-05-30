<?php

namespace Admin\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciForm;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;
use ModelModule\Model\Users\RespProc\UsersRespProcGetter;
use ModelModule\Model\Users\RespProc\UsersRespProcGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\NullException;

class ContrattiPubbliciFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {
            $helper = new ContrattiPubbliciFormControllerHelper();
            $helper->setSceltaContraenteGetterWrapper( new SceltaContraenteGetterWrapper(new SceltaContraenteGetter($em)) );
            $helper->setupSceltaContraenteRecords( array() );
            $helper->formatSceltaContraenteRecords();
            $helper->setUsersRespProcGetterWrapper( new UsersRespProcGetterWrapper(new UsersRespProcGetter($em)) );
            $helper->setupUsersRespProcRecords( array() );
            $helper->formatUsersRespProcRecords();

            if ( is_numeric($id) ) {
                $wrapper = new ContrattiPubbliciGetterWrapper( new ContrattiPubbliciGetter($em) );
                $wrapper->setInput( array('id' => $id, 'limit' => 1) );
                $wrapper->setupQueryBuilder();

                $records = $wrapper->getRecords();
            }

            $form = new ContrattiPubbliciForm();
            $form->addSceltaContraente( $helper->getSceltaContraenteRecords() );
            $form->addResponsabili( $helper->getUsersRespProcRecords() );
            $form->addDatePubblicazione();
            $form->addNumeroOfferteEDate();

            if (!empty($records)) {
                $formAction = 'contratti-pubblici/update';
                $formTitle = 'Modifica bando';

                $form->setData($records[0]);
            } else {
                $form->setData( array("insertDate" => date("Y-m-d"), "expireDate" => date("2030-m-d")) );

                $formAction = 'contratti-pubblici/insert';
                $formTitle = 'Nuovo bando';
            }

            $this->layout()->setVariables(array(
                'form'                       => $form,
                'formAction'                 => $formAction,
                'formTitle'                  => $formTitle,
                'formDescription'            => '&Egrave; consigliabile inserire testi brevi sul tema trattato, possibilmente in minuscolo.',
                'formBreadCrumbCategory'     => 'Contratti pubblici',
                'formBreadCrumbCategoryLink' => $this->url()->fromRoute('admin/contratti-pubblici-summary', array('lang' => 'it')),
                'formLabelSpanWidth'         => 3,
                'formControlSpanWidth'       => 9,
                'templatePartial'            => self::formTemplate
            ));

        } catch(NullException $e) {

            $this->layout()->setVariables(array(
                'templatePartial'   => 'message.phtml',
                'messageType'       => 'warning',
                'messageTitle'      => 'Errore verificato',
                'messageText'       => $e->getMessage()
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }
}