<?php

namespace Application\Controller\AttiConcessione;

use ModelModule\Model\AttiConcessione\AttiConcessioneControllerHelper;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetter;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetterWrapper;
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

        try{
            $helper = new AttiConcessioneControllerHelper();
            $helper->setAttiConcessioneGetterWrapper( new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)) );
            $helper->setupYearsRecords( array(
                    'fields' => 'DISTINCT(atti.anno) AS year',
                    'orderBy' => 'atti.id DESC'
                ),
                $page,
                null
            );
            $helper->setAttiConcessioneGetterWrapper( new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)) );
            $helper->setupAttiConcessioneGetterWrapperWithPaginator(
                array('orderBy' => 'atti.id DESC', 'attivo' => 1),
                $page,
                null
            );
            $helper->setUsersSettoriGetterWrapper( new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)) );
            $helper->setupSettoriRecords( array('orderBy' => 'settore.nome') );

            $wrapperArticoli = $helper->getAttiConcessioneGetterWrapperWithPaginator();

            $articoliRecords = $wrapperArticoli->addAttachmentsToPaginatorRecords(
                $wrapperArticoli->setupRecords(),
                array()
            );

            $form = new AttiConcessioneFormSearch();
            $form->addAnno( $helper->formatYears($helper->getYearsRecords()) );
            $form->addMainElements();
            $form->addUfficio($helper->getUsersSettoriRecords());
            $form->addSubmitSearchButton();

            $this->layout()->setVariables(array(
                'records'                       => $articoliRecords,
                'form'                          => $form,
                'paginator'                     => $wrapperArticoli->getPaginator(),
                'paginator_total_item_count'    => $wrapperArticoli->getPaginator()->getTotalItemCount(),
                'templatePartial'               => 'atti-concessione/atti-concessione.phtml',
            ));

        } catch(NullException $e) {
            $this->layout()->setVariables(array(
                'messageType'                   => 'warning',
                'messageText'                   => $e->getMessage(),
                'templatePartial'               => 'atti-concessione/atti-concessione.phtml',
            ));
        }

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }
}