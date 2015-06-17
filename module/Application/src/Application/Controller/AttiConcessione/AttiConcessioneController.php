<?php

namespace Application\Controller\AttiConcessione;

use ModelModule\Model\AttiConcessione\AttiConcessioneControllerHelper;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetter;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\AttiConcessione\AttiConcessioneFormSearch;
use ModelModule\Model\NullException;

class AttiConcessioneController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $templateDir = $this->layout()->getVariable('templateDir');

        $basicLayout = $this->layout()->getVariable('atti_concessione_basiclayout');

        try {
            $helper = new AttiConcessioneControllerHelper();

            $yearsRecords = $helper->recoverWrapperRecords(
                new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
                array(
                    'fields' => 'DISTINCT(atti.anno) AS year',
                    'orderBy' => 'atti.id DESC'
                ),
                $page,
                null
            );

            $wrapperArticoli = $helper->recoverWrapperRecordsPaginator(
                new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
                array('orderBy' => 'atti.id DESC', 'attivo' => 1),
                $page,
                null
            );

            $settoriRecords = $helper->recoverWrapperRecords(
                new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)),
                array('orderBy' => 'settore.nome')
            );

            $wrapperArticoli->setEntityManager($em);
            $articoliRecords = $wrapperArticoli->addAttachmentsToPaginatorRecords(
                $wrapperArticoli->setupRecords(),
                array(
                    'moduleId'  => ModulesContainer::atti_concessione,
                    'noScaduti' => 1,
                    'orderBy'   => 'ao.position'
                )
            );

            $form = new AttiConcessioneFormSearch();
            $form->addAnno( $helper->formatYears($yearsRecords) );
            $form->addMainElements();
            $form->addUfficio( $helper->formatForDropwdown($settoriRecords, 'id', 'nome') );
            $form->addSubmitSearchButton();

            $articoliPaginator = $wrapperArticoli->getPaginator();

            $this->layout()->setVariables(array(
                'records'                       => $articoliRecords,
                'form'                          => $form,
                'paginator'                     => $articoliPaginator,
                'paginator_total_item_count'    => $articoliPaginator->getTotalItemCount(),
                'templatePartial'               => 'atti-concessione/atti-concessione.phtml',
            ));

        } catch(NullException $e) {

            $this->layout()->setVariables(array(
                'messageType'                   => 'secondary',
                'messageText'                   => "Si &egrave; verificato un problema o un'assenza di dati necessari wper visualizzare la pagina richiesta",
                'templatePartial'               => 'atti-concessione/atti-concessione.phtml',
            ));

        }

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }
}