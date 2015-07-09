<?php

namespace Application\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormSearch;
use Zend\Session\Container as SessionContainer;

/**
 * Contratti Pubblici Frontend website Controller
 */
class ContrattiPubbliciController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');

        $templateDir = $this->layout()->getVariable('templateDir');

        $basicLayout = $this->layout()->getVariable('contratti_pubblici_basiclayout');

        $sessionContainer = new SessionContainer();
        $sessionSearch = $sessionContainer->offsetGet(ContrattiPubbliciSearchController::sessionIdentifier);

        try {
            $helper = new ContrattiPubbliciControllerHelper();
            $wrapper = $helper->recoverWrapperRecordsPaginator(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
                array(
                    'anno'       => isset($sessionSearch['anno']) ? $sessionSearch['anno'] : null,
                    'cig'        => isset($sessionSearch['cig']) ? $sessionSearch['cig'] : null,
                    'importo'    => isset($sessionSearch['importo']) ? $sessionSearch['importo'] : null,
                    'annullato'  => 0,
                    'pubblicare' => 1,
                    'attivo'     => 1,
                ),
                $page,
                null
            );
            $wrapper->setEntityManager($em);
            $contrattiWithAttachment = $wrapper->addAttachmentsToPaginatorRecords(
                $wrapper->setupRecords(),
                array(
                    'moduleId'  => ModulesContainer::contratti_pubblici_id,
                    'noScaduti' => 1,
                    'orderBy'   => 'a.position'
                )
            );
            $contrattiRecords = $wrapper->addListaPartecipanti($contrattiWithAttachment);

            $contrattiPaginator = $wrapper->getPaginator();

            $yearsRecords = $helper->recoverWrapperRecords(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
                array(
                    'fields'    => 'DISTINCT(cc.anno) AS anno',
                    'orderBy'   => 'cc.anno'
                )
            );
            if (!empty($yearsRecords)) {
                $yearsArray = array();
                foreach($yearsRecords as $year) {
                    $yearsArray[$year['anno']] = $year['anno'];
                }
            } else {
                $yearsArray = array();
            }

            $settoriRecords = $helper->recoverWrapperRecords(
                new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)),
                array()
            );
            $settori = array();
            foreach($settoriRecords as $settore) {
                $settori[$settore['id']] = $settore['nome'].' '.$settore['name'].' '.$settore['surname'];
            }

            $form = new ContrattiPubbliciFormSearch();
            $form->addYears($yearsArray);
            $form->addMainFormElements();
            $form->addSettori($settori);
            $form->addSubmit();

            if ($sessionSearch) {
                $form->setData(array(
                    'cig'       => isset($sessionSearch['cig']) ? $sessionSearch['cig'] : null,
                    'anno'      => isset($sessionSearch['anno']) ? $sessionSearch['anno'] : null,
                    'importo'   => isset($sessionSearch['importo']) ? $sessionSearch['importo'] : null,
                    'settore'   => isset($sessionSearch['settore']) ? $sessionSearch['settore'] : null,
                ));
            }

            $this->layout()->setVariables(array(
                'sessionSearch'              => $sessionSearch,
                'form'                       => $form,
                'emptyRecords'               => count($contrattiRecords),
                'records'                    => $contrattiRecords,
                'paginator'                  => $contrattiPaginator,
                'paginator_total_item_count' => $contrattiPaginator->getTotalItemCount(),
                'templatePartial'            => 'contratti-pubblici/contratti-pubblici.phtml',
            ));

        } catch(\Exception $e) {

        }

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }

    /**
     * Contratto details
     */
    public function detailsAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        try {

            $helper = new ContrattiPubbliciControllerHelper();
            $wrapper = $helper->recoverWrapperById(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
                array('id' => $id, 'attivo' => 1, 'limit' => 1),
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
                'templatePartial'   => 'contratti-pubblici/contratti-pubblici-details.phtml'
            ));

        } catch(\Exception $e) {

            $logWriter = new LogWriter($em->getConnection());
            $logWriter->writeLog(array(
                'user_id'       => 0,
                'module_id'     => ModulesContainer::contratti_pubblici_id,
                'message'       => "Errore visualizzazione contratti pubblici sul sito pubblico",
                'description'   => $e->getMessage(),
                'reference_id'  => 0,
                'type'          => 'error',
                'backend'       => 0,
            ));

            $this->layout()->setVariables(array(
                'messageType'       => 'secondary',
                'moduleLabel'       => "Bandi di gara e contratti",
                'messageTitle'      => "Nessun bando di gara in archivio",
                'messageText'       => "Impossibile visualizzare i dati richiesti",
                'templatePartial'   => 'message.phtml',
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}