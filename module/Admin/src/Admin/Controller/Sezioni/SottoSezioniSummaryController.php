<?php

namespace Admin\Controller\Sezioni;

use ModelModule\Model\Sezioni\SezioniControllerHelper;
use ModelModule\Model\Sezioni\SezioniGetter;
use ModelModule\Model\Sezioni\SezioniGetterWrapper;
use ModelModule\Model\Sezioni\SottoSezioniFormSearch;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Languages\LanguagesFormSearch;
use Application\Controller\SetupAbstractController;

class SottoSezioniSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em                     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $ammTraspSezioneId      = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');
        $ammTraspSottoSezioneId = $this->layout()->getVariable('amministrazione_trasparente_sottosezione_id');
        $configurations         = $this->layout()->getVariable('configurations');
        $page                   = $this->params()->fromRoute('page');
        $languageSelection      = $this->params()->fromRoute('languageSelection');
        $modulename             = $this->params()->fromRoute('modulename');
        //$userRole             = isset($userDetails->role) ? $userDetails->role : '';

        $helper = new SezioniControllerHelper();
        $helper->setSottoSezioniGetterWrapper(new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)));

        try {
            $helper->checkAmministrazioneTrasparenteId(
                $modulename,
                $ammTraspSezioneId,
                "Nessun ID sezione associato al modulo amm. trasparente. Contattare gli amministratori dell'applicazione"
            );

            $wrapper = $helper->recoverWrapperRecordsPaginator(
                $helper->getSottoSezioniGetterWrapper(),
                array(
                    'excludeSezioneId'      => $ammTraspSezioneId,
                    'languageAbbreviation'  => $languageSelection,
                ),
                $page,
                null
            );
            $helper->setSezioniGetterWrapper(new SezioniGetterWrapper(new SezioniGetter($em)));
            $sezioniRecords = $helper->recoverWrapperRecords(
                $helper->getSezioniGetterWrapper(),
                array(
                    'excludeSezioneId'      => $ammTraspSezioneId,
                    'languageAbbreviation'  => $languageSelection,
                    'fields'                => 'sezioni.id, sezioni.nome',
                    'orderBy'               => 'sezioni.posizione ASC',
                )
            );
            $helper->checkRecordset($sezioniRecords, 'Nessuna sezione presente');

            if ( (!empty($configurations['isMultiLanguage']))==1 ) {
                $helper->setLanguagesGetterWrapper(new LanguagesGetterWrapper(new LanguagesGetter($em)));

                $formLanguage = $helper->setupLanguageFormSearch(
                    new LanguagesFormSearch(),
                    array('status' => 1),
                    $languageSelection
                );
            }

            $formSearch = new SottoSezioniFormSearch();
            $formSearch->addSezioni( $helper->formatForDropwdown($sezioniRecords, 'id', 'nome') );
            $formSearch->addSubmitButton();

            $this->layout()->setVariables(array(
                'tableTitle'        => 'Sottosezioni contenuti',
                'tableDescription'  => $wrapper->getPaginator()->getTotalItemCount().' sottosezioni in archivio',
                'columns' => array(
                    "Nome",
                    "Sezione",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                ),
                'formLanguage'      => isset($formLanguage) ? $formLanguage : null,
                'paginator'         => $wrapper->getPaginator(),
                'records'           => $this->formatRecordsToShowOnTable($wrapper->setupRecords()),
                'formSearch'        => $formSearch,
                'templatePartial'   => 'datatable/datatable_sottosezioni.phtml',
            ));

        } catch(\Exception $e) {
            $this->layout()->setVariables(array(
                'messageText'       => $e->getMessage(),
                'templatePartial'   => 'message-exception.phtml',
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Format common columns values for the summary
     *
     * @param $records
     * @return array
     */
    protected function formatRecordsToShowOnTable($records)
    {
        $lang               = $this->params()->fromRoute('lang');
        $page               = $this->params()->fromRoute('page');
        $languageSelection  = $this->params()->fromRoute('languageSelection');
        $modulename         = $this->params()->fromRoute('modulename');
        $userDetails        = $this->layout()->getVariable('userDetails');

        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {
                $rowToAdd = array(
                    $row['nomeSottoSezione'],
                    $row['nomeSezione'],
                    array(
                        'type' => 'updateButton',
                        'href' => $this->url()->fromRoute('admin/sottosezioni-form', array(
                            'lang'               => $lang,
                            'id'                 => $row['idSottoSezione'],
                            'languageSelection'  => $languageSelection,
                            'previouspage'       => $page,
                            'modulename'         => $modulename
                        )),
                        'title'     => 'Modifica'
                    ),
                );

                if ($userDetails->acl->hasResource('amministrazione_trsparente_sottosezioni_delete')) {
                    $rowToAdd[] = array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['idSottoSezione'],
                        'title'     => 'Elimina'
                    );
                }

                if ($userDetails->acl->hasResource('amministrazione_trsparente_sottosezioni_update')) {
                    $rowToAdd[] = array(
                        'type' => 'positionButton',
                        'href' => $this->url()->fromRoute('admin/posizioni-sottosezioni', array(
                                'lang'              => $this->params()->fromRoute('lang'),
                                'languageSelection' => $this->params()->fromRoute('languageSelection'),
                                'sezioneId'         => $row['idSezione'],
                                'modulename'         => $modulename
                            )
                        ),
                        'title' => 'Gestione posizioni'
                    );
                }

                $arrayToReturn[] = $rowToAdd;
            }
        }

        return $arrayToReturn;
    }
}