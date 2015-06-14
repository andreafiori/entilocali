<?php

namespace Admin\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciForm;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;
use ModelModule\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;
use ModelModule\Model\Users\RespProc\UsersRespProcGetter;
use ModelModule\Model\Users\RespProc\UsersRespProcGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\NullException;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;

class ContrattiPubbliciFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lang = $this->params()->fromRoute('lang');
        $id = $this->params()->fromRoute('id');

        try {
            $helper = new ContrattiPubbliciControllerHelper();
            $sceltaContraenteRecords = $helper->recoverWrapperRecords(
                new SceltaContraenteGetterWrapper(new SceltaContraenteGetter($em)),
                array('orderBy' => '')
            );
            $helper->checkRecords($sceltaContraenteRecords, "Nessuna opzione di scelta contraente rilevata");
            $sceltaContraenteRecordsForDropDown = $helper->formatForDropwdown(
                $sceltaContraenteRecords,
                'id',
                'nomeScelta'
            );

            $responsabiliProcRecords = $helper->recoverWrapperRecords(
                new UsersRespProcGetterWrapper(new UsersRespProcGetter($em)),
                array('orderBy' => '')
            );
            $helper->checkRecords($responsabiliProcRecords, "Nessuna responsabile di procedimento rilevato");
            $responsabiliProcRecordsForDropDown = $helper->formatUsersRespProcRecords($responsabiliProcRecords);

            $contrattoRecord = $helper->recoverWrapperRecordsById(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
                array('id' => $id, 'limit' => 1),
                $id
            );

            $usersSettoriRecords = $helper->recoverWrapperRecords(
                new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)),
                array()
            );
            $helper->checkRecords($usersSettoriRecords, 'Nessun settore presente');
            $usersSettoriRecordsForDropDown = $helper->formatForDropwdown($usersSettoriRecords, 'id', 'nome');

            $form = new ContrattiPubbliciForm();
            $form->addDetermina();
            $form->addImporti();
            $form->addStrutturaProponenteLabel();
            $form->addResponsabili($responsabiliProcRecordsForDropDown);
            $form->addSceltaContraente($sceltaContraenteRecordsForDropDown);
            $form->addSettori($usersSettoriRecordsForDropDown);
            $form->addDatePubblicazione();
            $form->addNumeroOfferte();
            $form->addDataInizioFineLavori();
            // $form->addUsersSelect(); // TODO: add user selection

            if (!empty($contrattoRecord)) {

                $formAction = $this->url()->fromRoute('admin/contratti-pubblici-update', array(
                    'lang' => $lang
                ));
                $formTitle = 'Modifica bando';

                $form->setData($contrattoRecord[0]);
            } else {

                $form->setData( array("dataInserimento" => date("Y-m-d H:i:s")) );

                $formAction = $this->url()->fromRoute('admin/contratti-pubblici-insert', array('lang' => $lang));
                $formTitle = 'Nuovo bando';
            }

            $this->layout()->setVariables(array(
                'form'                       => $form,
                'formAction'                 => $formAction,
                'formTitle'                  => $formTitle,
                'formDescription'            => '&Egrave; consigliabile inserire testi brevi sul tema trattato, possibilmente in minuscolo.',
                'formBreadCrumbCategory'     => 'Contratti pubblici',
                'formBreadCrumbCategoryLink' => $this->url()->fromRoute('admin/contratti-pubblici-summary', array(
                    'lang' => $lang
                )),
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