<?php

namespace Admin\Controller\Sezioni;

use Admin\Model\Sezioni\SezioniControllerHelper;
use Admin\Model\Sezioni\SezioniGetter;
use Admin\Model\Sezioni\SezioniGetterWrapper;
use Admin\Model\Sezioni\SottoSezioniFormSearch;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
use Admin\Model\Languages\LanguagesGetter;
use Admin\Model\Languages\LanguagesGetterWrapper;
use Admin\Model\Languages\LanguagesFormSearch;

class SottoSezioniContenutiSummaryController extends SottoSezioniControllerAbstract
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em                     = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $ammTraspSezioneId      = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');
        $ammTraspSottoSezioneId = $this->layout()->getVariable('amministrazione_trasparente_sottosezione_id');
        $configurations         = $this->layout()->getVariable('configurations');
        $userDetails            = $this->layout()->getVariable('userDetails');
        $userRole               = isset($userDetails->role) ? $userDetails->role : '';
        $page                   = $this->params()->fromRoute('page');
        $languageSelection      = $this->params()->fromRoute('languageSelection');

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
}