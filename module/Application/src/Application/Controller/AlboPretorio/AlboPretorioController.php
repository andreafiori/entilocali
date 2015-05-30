<?php

namespace Application\Controller\AlboPretorio;

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

        $wrapper = new AlboPretorioArticoliGetterWrapper( new AlboPretorioArticoliGetter($em) );
        $wrapper->setInput(array(
            'orderBy' => 'alboArticoli.id DESC'
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage(isset($page) ? $page : null);

        $sezioniWrapper = new AlboPretorioSezioniGetterWrapper( new AlboPretorioSezioniGetter($em) );
        $sezioniWrapper->setInput(array(

        ));
        $sezioniWrapper->setupQueryBuilder();

        $usersSettoriWrapper = new UsersSettoriGetterWrapper( new UsersSettoriGetter($em) );
        $usersSettoriWrapper->setInput(array('orderBy' => 'settore.nome ASC'));
        $usersSettoriWrapper->setupQueryBuilder();

        $formSearch = new AlboPretorioFormSearch();
        $formSearch->addYears();
        $formSearch->addSezioni( $sezioniWrapper->formatForDropwdown($sezioniWrapper->getRecords(), 'id', 'nome') );
        $formSearch->addSettori( $usersSettoriWrapper->formatForDropwdown($usersSettoriWrapper->getRecords(), 'id', 'nome') );
        $formSearch->addCheckExpired();
        $formSearch->addCsrf();
        $formSearch->addSubmitButton();

        $wrapper->setEntityManager($em);
        $mainRecords = $wrapper->addAttachmentsToPaginatorRecords($wrapper->setupRecords(), array(
            'moduleId' => ModulesContainer::albo_pretorio_id
        ));

        $this->layout()->setVariables(array(
            'templatePartial'   => 'albo-pretorio/albo-pretorio.phtml',
            'form'              => $formSearch,
            'paginator'         => $wrapper->getPaginator(),
            'records'           => $mainRecords,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}