<?php

namespace Application\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioControllerHelper;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\AlboPretorio\AlboPretorioFormSearch;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;

class AlboPretorioController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new AlboPretorioControllerHelper();
        $articoliWrapper = $helper->recoverWrapperRecordsPaginator(
            new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
            array('orderBy' => 'alboArticoli.id DESC'),
            $page,
            null
        );
        $sezioniRecords = $helper->recoverWrapperRecords(
            new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($em)),
            array()
        );

        $formSearch = new AlboPretorioFormSearch();
        $formSearch->addYears();
        $formSearch->addSezioni( $helper->formatForDropwdown($sezioniRecords, 'id', 'nome') );
        $formSearch->addCheckExpired();
        $formSearch->addCsrf();
        $formSearch->addSubmitButton();

        $articoliWrapper->setEntityManager($em);

        $mainRecords = $articoliWrapper->addAttachmentsToPaginatorRecords(
            $articoliWrapper->setupRecords(),
            array('moduleId' => ModulesContainer::albo_pretorio_id)
        );

        $this->layout()->setVariables(array(
            'form'              => $formSearch,
            'paginator'         => $articoliWrapper->getPaginator(),
            'records'           => $mainRecords,
            'templatePartial'   => 'albo-pretorio/albo-pretorio.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}