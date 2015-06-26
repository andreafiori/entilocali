<?php

namespace Application\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormSearch;

class ContrattiPubbliciController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');

        $templateDir = $this->layout()->getVariable('templateDir');

        $basicLayout = $this->layout()->getVariable('contratti_pubblici_basiclayout');

        try {
            $helper = new ContrattiPubbliciControllerHelper();
            $wrapper = $helper->recoverWrapperRecordsPaginator(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
                array(
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
                    'noScaduti' => 1
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
            $yearsArray = array();
            foreach($yearsRecords as $year) {
                $yearsArray[] = $year['anno'];
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

            $this->layout()->setVariables(array(
                'form'                       => $form,
                'records'                    => $contrattiRecords,
                'paginator'                  => $contrattiPaginator,
                'paginator_total_item_count' => $contrattiPaginator->getTotalItemCount(),
                'templatePartial'            => 'contratti-pubblici/contratti-pubblici.phtml',
            ));

        } catch(\Exception $e) {
            // echo $e->getMessage();
        }

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }

    public function detailsAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');

        try {

            $helper = new ContrattiPubbliciControllerHelper();
            $wrapper = $helper->recoverWrapperById(
                new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
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
                'templatePartial'   => 'contratti-pubblici/contratti-pubblici-details.phtml'
            ));

        } catch(\Exception $e) {

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