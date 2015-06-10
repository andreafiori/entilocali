<?php

namespace Admin\Controller\AttiConcessione;

use ModelModule\Model\AttiConcessione\AttiConcessioneControllerHelper;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetter;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use ModelModule\Model\AttiConcessione\AttiConcessioneForm;
use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetter;
use ModelModule\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetterWrapper;
use ModelModule\Model\Users\RespProc\UsersRespProcGetter;
use ModelModule\Model\Users\RespProc\UsersRespProcGetterWrapper;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;

class AttiConcessioneFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');

        try {

            $helper = new AttiConcessioneControllerHelper();

            $respProcRecords = $helper->recoverWrapperRecords(
                new UsersRespProcGetterWrapper(new UsersRespProcGetter($em)),
                array()
            );

            $helper->checkRecords($respProcRecords, 'Nessun responsabile procedimento');

            $respProcForDropdown = $helper->formatResponsabiliForDropdown($respProcRecords);

            $sezioniRecords = $helper->recoverWrapperRecords(
                new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)),
                array('orderBy' => 'settore.nome')
            );
            $helper->checkRecords($sezioniRecords, 'Nessuna sezione presente');

            $sezioniRecordsForDropDown = $helper->formatForDropwdown($sezioniRecords, 'id', 'nome');

            $modalitaAssegnazioneRecords = $helper->recoverWrapperRecords(
                new AttiConcessioneModalitaAssegnazioneGetterWrapper(
                    new AttiConcessioneModalitaAssegnazioneGetter($em)
                ),
                array()
            );
            $modAssegnForDropdown = $helper->formatForDropwdown($modalitaAssegnazioneRecords, 'id', 'nome');

            $attiRecords = $helper->recoverWrapperRecordsById(
                new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
                array('aa.id' => $id, 'limit' => 1),
                $id
            );

            $form = new AttiConcessioneForm();
            $form->addUfficioResponsabile($sezioniRecordsForDropDown);
            $form->addResponsabileProcedimento($respProcForDropdown);
            $form->addModalitaAssegnazione($modAssegnForDropdown);
            $form->addTitoloDataInserimentoEAnno();

            if (!empty($attiRecords)) {
                $formAction         = $this->url()->fromRoute('admin/atti-concessione-update', array(
                    'lang' => $lang
                ));
                $formTitle          = 'Modifica atto di concessione';
                $formDescription    = 'Modifica nuovo atto di concessione';

                $form->setData($attiRecords[0]);

            } else {

                $form->setData(array('anno' => date('Y')+5));

                $formAction      = $this->url()->fromRoute('admin/atti-concessione-insert', array(
                    'lang' => $lang
                ));
                $formTitle       = 'Nuovo atto di concessione';
                $formDescription = 'Inserisci nuovo atto di concessione';
            }

            $this->layout()->setVariables( array(
                    'form'                       => $form,
                    'formAction'                 => $formAction,
                    'formTitle'                  => $formTitle,
                    'formDescription'            => $formDescription,
                    'formBreadCrumbCategory'     => 'Atti di concessione',
                    'formBreadCrumbCategoryLink' => $this->url()->fromRoute('admin/atti-concessione-summary', array(
                        'lang' => $lang
                    )),
                    'noFormActionPrefix'         => 1,
                    'templatePartial'            => self::formTemplate,
                )
            );

            $this->layout()->setTemplate($mainLayout);

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'messageType'       => 'danger',
                'messageTitle'      => 'Errore o problema verificato',
                'messageText'       => $e->getMessage(),
                'templatePartial'   => 'message.phtml',
            ));

            $this->layout()->setTemplate($mainLayout);
        }
    }
}