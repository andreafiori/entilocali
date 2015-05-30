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

class SottoSezioniContenutiSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em                     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $ammTraspSezioneId      = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');
        //$ammTraspSottoSezioneId = $this->layout()->getVariable('amministrazione_trasparente_sottosezione_id');
        $configurations         = $this->layout()->getVariable('configurations');
        $page                   = $this->params()->fromRoute('page');
        $languageSelection      = $this->params()->fromRoute('languageSelection');
        //$userDetails            = $this->layout()->getVariable('userDetails');
        //$userRole               = isset($userDetails->role) ? $userDetails->role : '';

        $helper = new SezioniControllerHelper();
        $helper->setSottoSezioniGetterWrapper(new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)));

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
        $sezioniRecordsForDropDown = $helper->formatForDropwdown(
            $helper->recoverWrapperRecords(
                $helper->getSezioniGetterWrapper(),
                array(
                    'excludeSezioneId'      => $ammTraspSezioneId,
                    'languageAbbreviation'  => $languageSelection,
                    'fields'                => 'sezioni.id, sezioni.nome',
                    'orderBy'               => 'sezioni.posizione ASC',
                )
            ),
            'id',
            'nome'
        );

        $isMultiLanguage = !empty($configurations['isMultiLanguage']);
        if ($isMultiLanguage==1) {
            $helper->setLanguagesGetterWrapper(new LanguagesGetterWrapper(new LanguagesGetter($em)));

            $formLanguage = $helper->setupLanguageFormSearch(
                new LanguagesFormSearch(),
                array('status' => 1),
                $languageSelection
            );
        }

        $paginatorRecords = $wrapper->setupRecords();

        $formSearch = new SottoSezioniFormSearch();
        $formSearch->addSezioni($sezioniRecordsForDropDown);
        $formSearch->addSubmitButton();

        $this->layout()->setVariables(array(
            'tableTitle' => 'Sottosezioni contenuti',
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
            'records'           => $this->formatRecordsToShowOnTable($paginatorRecords),
            'formSearch'        => $formSearch,
            'templatePartial'   => 'datatable/datatable_sottosezioni_contenuti.phtml',
        ));

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
        $lang = $this->params()->fromRoute('lang');
        $page = $this->params()->fromRoute('page');
        $languageSelection = $this->params()->fromRoute('languageSelection');

        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {
                $rowToAdd = array(
                    $row['nomeSottoSezione'],
                    $row['nomeSezione'],
                    array(
                        'type' => 'updateButton',
                        'href' => $this->url()->fromRoute('admin/sottosezioni-contenuti-form', array(
                            'lang'               => $lang,
                            'id'                 => $row['idSottoSezione'],
                            'languageSelection'  => $languageSelection,
                            'previouspage'       => $page,
                        )),
                        'title'     => 'Modifica'
                    ),
                );

                //if ($this->getAcl()->hasResource('amministrazione_trsparente_sottosezioni_delete')) {
                $rowToAdd[] = array(
                    'type'      => 'deleteButton',
                    'href'      => '#',
                    'data-id'   => $row['idSottoSezione'],
                    'title'     => 'Elimina'
                );
                //}

                //if ($this->getAcl()->hasResource('amministrazione_trsparente_sottosezioni_update')) {
                $rowToAdd[] = array(
                    'type' => 'positionButton',
                    'href' => $this->url()->fromRoute('admin/posizioni-sottosezioni', array(
                            'lang'              => $this->params()->fromRoute('lang'),
                            'languageSelection' => $this->params()->fromRoute('languageSelection'),
                            'sezioneId'         => $row['idSezione'],
                        )
                    ),
                    'title' => 'Gestione posizioni'
                );
                //}

                $arrayToReturn[] = $rowToAdd;
            }
        }

        return $arrayToReturn;
    }
}