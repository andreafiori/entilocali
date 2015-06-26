<?php

namespace Application\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\AlboPretorio\AlboPretorioFormSearch;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class AlboPretorioController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        try {

            $helper = new AlboPretorioControllerHelper();
            $sezioniRecords = $helper->recoverWrapperRecords(
                new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($em)),
                array()
            );
            $articoliWrapper = $helper->recoverWrapperRecordsPaginator(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                array('orderBy' => 'alboArticoli.id DESC', 'pubblicare' => 1),
                $page,
                null
            );

            $articoliWrapper->setEntityManager($em);

            $mainRecords = $articoliWrapper->addAttachmentsToPaginatorRecords(
                $articoliWrapper->setupRecords(),
                array(
                    'moduleId'  => ModulesContainer::albo_pretorio_id,
                    'noScaduti' => 1,
                    'orderBy'   => 'ao.position'
                )
            );

            $formSearch = new AlboPretorioFormSearch();
            $formSearch->addYears();
            $formSearch->addSezioni( $helper->formatForDropwdown($sezioniRecords, 'id', 'nome') );
            $formSearch->addCheckExpired();
            $formSearch->addCsrf();
            $formSearch->addSubmitButton();

            $this->layout()->setVariables(array(
                'form'              => $formSearch,
                'paginator'         => $articoliWrapper->getPaginator(),
                'records'           => $mainRecords,
                'templatePartial'   => 'albo-pretorio/albo-pretorio.phtml',
            ));

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'messageTitle'      => 'Si &egrave; verificato un problema:',
                'messageText'       => $e->getMessage(),
                'moduleLabel'       => 'Albo pretorio',
                'templatePartial'   => 'message.phtml',
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * Albo atto details page
     */
    public function detailsAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        try {

            $helper = new AlboPretorioControllerHelper();
            $wrapper = $helper->recoverWrapperById(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                array('id' => $id, 'limit' => 1),
                $id
            );
            $attoRecord = $wrapper->getRecords();
            $helper->checkRecords($attoRecord, 'Nessun atto albo pretorio trovato');
            $wrapper->setEntityManager($em);
            $records = $wrapper->addAttachmentsFromRecords(
                $attoRecord,
                array(
                    'moduleId'  => ModulesContainer::albo_pretorio_id,
                    'noScaduti' => 1,
                    'orderBy'   => 'ao.position'
                )
            );

            $this->layout()->setVariables(array(
                'records'           => $records,
                'templatePartial'   => 'albo-pretorio/albo-pretorio-details.phtml'
            ));

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'messageType'       => 'secondary',
                'moduleLabel'       => "Atti di concessione",
                'messageTitle'      => "Nessun atto di concessione trovato",
                'messageText'       => "Impossibile visualizzare i dati richiesti",
                'templatePartial'   => 'message.phtml',
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }
}