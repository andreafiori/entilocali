<?php

namespace Admin\Controller\AttiConcessione;

use Admin\Model\AttiConcessione\AttiConcessioneGetter;
use Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use Admin\Model\AttiConcessione\AttiConcessioneForm;
use Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetter;
use Admin\Model\AttiConcessione\ModalitaAssegnazione\AttiConcessioneModalitaAssegnazioneGetterWrapper;
use Admin\Model\Users\RespProc\UsersRespProcGetter;
use Admin\Model\Users\RespProc\UsersRespProcGetterWrapper;
use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * @author Andrea Fiori
 * @since  28 April 2015
 */
class AttiConcessioneFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $id = $this->params()->fromRoute('id');

        $wrapper = new UsersRespProcGetterWrapper( new UsersRespProcGetter($em) );
        $wrapper->setInput(array());
        $wrapper->setupQueryBuilder();

        $records = $wrapper->getRecords();

        $responsabiliProcedimento = array();
        foreach($records as $record) {
            if (isset($record['name']) and isset($record['surname'])) {
                $responsabiliProcedimento[$record['id']] = $record['name'].' '.$record['surname'];
            }
        }

        if (empty($responsabiliProcedimento)) {

            $this->layout()->setVariables(array(
                'templatePartial'   => 'message.phtml',
                'messageType'       => 'warning',
                'messageTitle'      => 'Nessun responsabile procedimento',
                'messageText'       => "Inserire almeno un responsabile procedimento"
            ));

            $this->layout()->setTemplate($mainLayout);

            return false;
        }

        $wrapper = new UsersSettoriGetterWrapper( new UsersSettoriGetter($em) );
        $wrapper->setInput( array('orderBy' => 'settore.nome') );
        $wrapper->setupQueryBuilder();

        $sezioniRecordsFromWrapper = $wrapper->getRecords();

        $sezioniRecords = array();
        foreach($sezioniRecordsFromWrapper as $record) {
            $sezioniRecords[$record['id']] = $record['nome'];
        }

        if (empty($sezioniRecords)) {

            $this->layout()->setVariables(array(
                'templatePartial'   => 'message.phtml',
                'messageType'       => 'warning',
                'messageTitle'      => 'Nessuna sezione',
                'messageText'       => "Non &egrave; possibile inserire un nuovo atto. Inserire almeno una sezione."
            ));

            $this->layout()->setTemplate($mainLayout);

            return false;
        }

        $wrapper = new AttiConcessioneModalitaAssegnazioneGetterWrapper(
            new AttiConcessioneModalitaAssegnazioneGetter($em)
        );
        $wrapper->setInput(array());
        $wrapper->setupQueryBuilder();

        $records = $wrapper->getRecords();

        $modalitaAssegnazioneRecords = array();
        foreach($records as $record) {
            $modalitaAssegnazioneRecords[$record['id']] = $record['nome'];
        }

        $form = new AttiConcessioneForm();
        $form->addUfficioResponsabile($sezioniRecords);
        $form->addResponsabileProcedimento($responsabiliProcedimento);
        $form->addModalitaAssegnazione($modalitaAssegnazioneRecords);
        $form->addTitoloDataInserimentoEAnno();

        $routeOptionId = isset($id) ? $id : null;

        if ( is_numeric($routeOptionId) ) {
            $wrapper = new AttiConcessioneGetterWrapper( new AttiConcessioneGetter($em) );
            $wrapper->setInput( array('aa.id' => $routeOptionId, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            $attiRecords =  $wrapper->getRecords();
        }

        if (!empty($attiRecords)) {
            $formAction         = 'atti-concessione/update';
            $formTitle          = 'Modifica atto di concessione';
            $formDescription    = 'Modifica nuovo atto di concessione';

            $attiRecords[0]['importo'] = utf8_encode($attiRecords[0]['importo']);

            $form->setData($attiRecords[0]);

        } else {

            $form->setData(array('anno' => date('Y')+5));

            $formAction      = 'atti-concessione/insert';
            $formTitle       = 'Nuovo atto di concessione';
            $formDescription = 'Inserisci nuovo atto di concessione';
        }

        $this->layout()->setVariables( array(
            'form'                       => $form,
            'formAction'                 => $formAction,
            'formTitle'                  => $formTitle,
            'formDescription'            => $formDescription,
            'templatePartial'            => self::formTemplate,
            'formBreadCrumbCategory'     => 'Atti di concessione',
            'formBreadCrumbCategoryLink' => $this->url()->fromRoute('admin/atti-concessione-summary', array('lang' => 'it') )
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}