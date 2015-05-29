<?php

namespace Admin\Controller\Sezioni;

use Admin\Model\Sezioni\SezioniControllerHelper;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
use Admin\Model\Languages\LanguagesGetter;
use Admin\Model\Languages\LanguagesGetterWrapper;
use Admin\Model\Languages\LanguagesFormSearch;

class SottoSezioniAmministrazioneTrasparenteSummaryController extends SottoSezioniControllerAbstract
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
            'records'           => $this->formatRecordsToShowOnTable($paginatorRecords),
            'templatePartial'   => 'datatable/datatable_sottosezioni_ammtrasp.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}