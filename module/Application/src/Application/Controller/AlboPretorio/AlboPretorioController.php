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
use Zend\Session\Container as SessionContainer;

/**
 * AlboPretorio Frontend Controller
 */
class AlboPretorioController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $sessionContainer = new SessionContainer();
        $sessionSearch = $sessionContainer->offsetGet(AlboPretorioSearchController::sessionIdentifier);

        try {

            $helper = new AlboPretorioControllerHelper();
            $sezioniRecords = $helper->recoverWrapperRecords(
                new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($em)),
                array()
            );
            $articoliWrapper = $helper->recoverWrapperRecordsPaginator(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
                array(
                    'freeSearch'        => isset($sessionSearch['testo']) ? $sessionSearch['testo'] : null,
                    'sezioneId'         => isset($sessionSearch['sezine']) ? $sessionSearch['sezine'] : null,
                    'numeroProgressivo' => isset($sessionSearch['numero_progressivo']) ? $sessionSearch['numero_progressivo'] : null,
                    'numeroAtto'        => isset($sessionSearch['numero_atto']) ? $sessionSearch['numero_atto'] : null,
                    'mese'              => isset($sessionSearch['mese']) ? $sessionSearch['mese'] : null,
                    'anno'              => isset($sessionSearch['anno']) ? $sessionSearch['anno'] : null,
                    'noScaduti'         => 1,
                    'pubblicare'        => 1,
                    'orderBy'           => 'alboArticoli.numeroProgressivo DESC',
                ),
                $page,
                null
            );

            $articoliWrapper->setEntityManager($em);

            $mainRecords = $articoliWrapper->addAttachmentsToPaginatorRecords(
                $articoliWrapper->setupRecords(),
                array(
                    'moduleId'  => ModulesContainer::albo_pretorio_id,
                    'noScaduti' => 1,
                    'status'    => 1,
                    'orderBy'   => 'a.position'
                )
            );

            $formSearch = new AlboPretorioFormSearch();
            $formSearch->addYears();
            $formSearch->addSezioni( $helper->formatForDropwdown($sezioniRecords, 'id', 'nome') );
            $formSearch->addCheckExpired();
            $formSearch->addSubmitButton();

            if (!empty($sessionSearch)) {
                $formSearch->setData(array(
                    'numero_progressivo'    => $sessionSearch['numero_progressivo'],
                    'numero_atto'           => $sessionSearch['numero_atto'],
                    'mese'                  => $sessionSearch['mese'],
                    'anno'                  => $sessionSearch['anno'],
                    'sezione'               => $sessionSearch['sezione'],
                    'testo'                 => $sessionSearch['testo'],
                    'expired'               => $sessionSearch['expired'],
                ));
            }

            $this->layout()->setVariables(array(
                'sessionSearch'     => $sessionSearch,
                'form'              => $formSearch,
                'paginator'         => $articoliWrapper->getPaginator(),
                'emptyRecords'      => count($mainRecords),
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
                    'orderBy'   => 'a.position'
                )
            );

            $this->layout()->setVariables(array(
                'records'           => $records,
                'templatePartial'   => 'albo-pretorio/albo-pretorio-details.phtml'
            ));

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'messageType'       => 'secondary',
                'moduleLabel'       => "Albo pretorio",
                'messageTitle'      => "Nessun albo pretorio trovato",
                'messageText'       => "Impossibile visualizzare i dati richiesti sul sito pubblico",
                'templatePartial'   => 'message.phtml',
            ));

        }

        $this->layout()->setTemplate($mainLayout);
    }
}