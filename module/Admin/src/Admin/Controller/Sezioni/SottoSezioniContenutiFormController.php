<?php

namespace Admin\Controller\Sezioni;

use ModelModule\Model\Sezioni\SezioniControllerHelper;
use ModelModule\Model\Sezioni\SezioniGetter;
use ModelModule\Model\Sezioni\SezioniGetterWrapper;
use ModelModule\Model\Sezioni\SottoSezioniForm;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class SottoSezioniContenutiFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $configurations = $this->layout()->getVariable('configurations');
        $id = $this->params()->fromRoute('id');
        $module = $this->params()->fromRoute('module');
        $lang = $this->params()->fromRoute('lang');
        $page = $this->params()->fromRoute('page');
        $languageSelection = $this->params()->fromRoute('languageSelection');

        try{

            $helper = new SezioniControllerHelper();
            $helper->setSottoSezioniGetterWrapper(new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)));
            $helper->setupSottoSezioniGetterWrapperRecords(array('id' => $id, 'limit' => 1));
            $helper->assertSottoSezioniGetterWrapperRecords();
            $helper->setSezioniGetterWrapper(new SezioniGetterWrapper(new SezioniGetter($em)));
            $helper->setupSezioniGetterWrapperRecords(array(
                'fields'    => 'sezioni.id, sezioni.nome',
                //'sezioneId' => ($module=='amm-trasparente') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
                'excludeId' => ($module=='contenuti') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
                'orderBy'   => 'sezioni.nome'
            ));

        } catch(\Exception $e) {
            // TODO: render a message...
        }

        if (is_numeric($id)) {
            $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($em) );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            $recordFromDb = $wrapper->getRecords();
        }

        $wrapper = new SezioniGetterWrapper(new SezioniGetter($em));
        $wrapper->setInput(array(
            'fields'    => 'sezioni.id, sezioni.nome',
            'sezioneId' => ($module=='amm-trasparente') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'excludeId' => ($module=='contenuti') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'orderBy'   => 'sezioni.nome'
        ));
        $wrapper->setupQueryBuilder();

        $sezioniOptions = $wrapper->getRecords();

        if (empty($sezioniOptions)) {
            // error...
            return;
        }

        $form = new SottoSezioniForm();
        $form->addSezioni( $this->formatSezioniRecordsForFormSelect($sezioniOptions) );
        $form->addMainFormInputs();

        if (!empty($recordFromDb)) {
            $form->setData($recordFromDb[0]);

            $formTitle          = $recordFromDb[0]['nomeSottoSezione'];
            $formAction         = 'sottosezioni-contenuti/update/';
            $submitButtonValue  = 'Modifica';
        } else {
            $formTitle          = 'Nuova sotto sezione';
            $submitButtonValue  = 'Inserisci';
            $formAction         = 'sottosezioni-contenuti/insert/';
        }

        $this->layout()->setVariables(array(
            'form'                          => $form,
            'formAction'                    => $formAction,
            'formTitle'                     => $formTitle,
            'formDescription'               => 'Dati relativi alle sotto sezioni',
            'submitButtonValue'             => $submitButtonValue,
            'formBreadCrumbCategory'        => 'Sottosezioni contenuti',
            'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/sottosezioni-contenuti-summary', array(
                'lang'               => $lang,
                'languageSelection'  => $languageSelection,
                'previouspage'       => $page,
            )),
            'templatePartial'               => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array $records
     *
     * @return array
     */
    private function formatSezioniRecordsForFormSelect(array $records)
    {
        $arrayToReturn = array();
        foreach($records as $record) {
            $arrayToReturn[$record['id']] = $record['nome'];
        }
        return $arrayToReturn;
    }
}