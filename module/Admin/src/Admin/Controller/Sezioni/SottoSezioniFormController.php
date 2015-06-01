<?php

namespace Admin\Controller\Sezioni;

use ModelModule\Model\NullException;
use ModelModule\Model\Sezioni\SezioniControllerHelper;
use ModelModule\Model\Sezioni\SezioniGetter;
use ModelModule\Model\Sezioni\SezioniGetterWrapper;
use ModelModule\Model\Sezioni\SottoSezioniForm;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class SottoSezioniFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em                 = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $configurations     = $this->layout()->getVariable('configurations');
        $id                 = $this->params()->fromRoute('id');
        $modulename         = $this->params()->fromRoute('modulename');
        $lang               = $this->params()->fromRoute('lang');
        $page               = $this->params()->fromRoute('page');
        $languageSelection  = $this->params()->fromRoute('languageSelection');

        try {
            $helper = new SezioniControllerHelper();
            $helper->checkAmministrazioneTrasparenteId(
                $modulename,
                isset($configurations['amministrazione_trasparente_sezione_id']) ? $configurations['amministrazione_trasparente_sezione_id'] : null,
                "Nessun ID sezione associato al modulo amm. trasparente. Contattare gli amministratori dell'applicazione"
            );
            $helper->setSezioniGetterWrapper(new SezioniGetterWrapper(new SezioniGetter($em)));
            $helper->setupSezioniGetterWrapperRecords(array(
                'fields'    => 'sezioni.id, sezioni.nome',
                'sezioneId' => ($modulename=='amministrazione-trasparente') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
                'excludeId' => ($modulename=='contenuti') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
                'orderBy'   => 'sezioni.nome'
            ));
            $helper->checkRecordset(
                $helper->getSezioniGetterWrapperRecords(),
                'Nessuna sezione in archivio. Impossibile inserire una sottosezione. Inserire almeno una sezione'
            );
            $helper->setSottoSezioniGetterWrapper(new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)));

            $sottoSezioniRecords = $helper->recoverWrapperRecordsById(
                $helper->getSottoSezioniGetterWrapper(),
                array('id' => $id, 'limit' => 1),
                $id
            );

            $form = new SottoSezioniForm();
            $form->addSezioni( $this->formatSezioniRecordsForFormSelect($helper->getSezioniGetterWrapperRecords()) );
            $form->addMainFormInputs();

            if (!empty($sottoSezioniRecords)) {
                $form->setData($sottoSezioniRecords[0]);

                $formTitle              = $sottoSezioniRecords[0]['nomeSottoSezione'];
                $formAction             = '#';
                $submitButtonValue      = 'Modifica';
                $formBreadCrumbTitle    = 'Modifica';

            } else {
                $formTitle              = 'Nuova sottosezione';
                $formBreadCrumbTitle    = 'Nuova';
                $submitButtonValue      = 'Inserisci';
                $formAction             = '#';
            }

            $this->layout()->setVariables(array(
                'form'                          => $form,
                'formAction'                    => $formAction,
                'formTitle'                     => $formTitle,
                'formDescription'               => 'Dati relativi alle sotto sezioni',
                'noFormActionPrefix'            => 1,
                'submitButtonValue'             => $submitButtonValue,
                'formBreadCrumbTitle'           => $formBreadCrumbTitle,
                'formBreadCrumbCategory'        => 'Sottosezioni',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/sottosezioni-summary', array(
                    'lang'               => $lang,
                    'languageSelection'  => $languageSelection,
                    'modulename'         => $modulename,
                    'previouspage'       => $page,
                )),
                'templatePartial'               => self::formTemplate,
            ));

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                'messageType'        => 'warning',
                'messageTitle'       => 'Errore verificato',
                'messageText'        => $e->getMessage(),
                'templatePartial'    => 'message.phtml',
            ));
        }

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