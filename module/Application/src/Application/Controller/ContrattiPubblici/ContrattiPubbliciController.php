<?php

namespace Application\Controller\ContrattiPubblici;

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

        $wrapper = new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em));
        $wrapper->setInput(array(
            'annullato'  => 0,
            'pubblicare' => 1,
            'attivo'     => 1,
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em));
        $wrapper->setupPaginatorCurrentPage(isset($page) ? $page : 0);
        $wrapper->setEntityManager($em);

        $contrattiRecords = $wrapper->addAttachmentsToPaginatorRecords(
            $wrapper->setupRecords(),
            array(
                'moduleId'  => ModulesContainer::contratti_pubblici_id,
                'noScaduti' => 1
            )
        );

        $contrattiPaginator = $wrapper->getPaginator();

        $wrapper = new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em));
        $wrapper->setInput(array(
            'fields'    => 'DISTINCT(cc.anno) AS anno',
            'orderBy'   => 'cc.anno'
        ));
        $wrapper->setupQueryBuilder();

        $years = $wrapper->getRecords();

        $yearsArray = array();
        foreach($years as $year) {
            $yearsArray[] = $year['anno'];
        }

        $wrapper = new UsersSettoriGetterWrapper(new UsersSettoriGetter($em));
        $wrapper->setInput(array());
        $wrapper->setupQueryBuilder();

        $settoriRecords = $wrapper->getRecords();

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

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }
}