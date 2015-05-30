<?php

namespace Admin\Controller\Sezioni;

use ModelModule\Model\Sezioni\SezioniControllerHelper;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Languages\LanguagesFormSearch;
use Application\Controller\SetupAbstractController;

class SottoSezioniAmministrazioneTrasparenteSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em                     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $ammTraspSezioneId      = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');
        $configurations         = $this->layout()->getVariable('configurations');
        $page                   = $this->params()->fromRoute('page');
        $languageSelection      = $this->params()->fromRoute('languageSelection');

        $helper = new SezioniControllerHelper();
        $helper->setSottoSezioniGetterWrapper(new SottoSezioniGetterWrapper(new SottoSezioniGetter($em)));

        $wrapper = $helper->recoverWrapperRecordsPaginator(
            $helper->getSottoSezioniGetterWrapper(),
            array(
                'excludeSezioneId'      => $ammTraspSezioneId,
                'languageAbbreviation'  => $languageSelection,
                'orderBy'               => ''
            ),
            $page,
            null
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

        $this->layout()->setVariables(array(
            'tableTitle' => 'Sottosezioni amministrazione trasparente',
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
            //'records'           => $this->formatRecordsToShowOnTable($paginatorRecords),
            'templatePartial'   => 'datatable/datatable_sottosezioni_ammtrasp.phtml',
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
                        'title' => 'Modifica'
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
                            'languageSelection' => $languageSelection,
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