<?php

namespace Application\Controller\AttiConcessione;

use Admin\Model\AttiConcessione\AttiConcessioneGetter;
use Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * @author Andrea Fiori
 * @since  15 April 2015
 */
class AttiConcessioneController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $page = $this->params()->fromRoute('page');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $basicLayout = $this->layout()->getVariable('atti_concessione_basiclayout');

        $templateDir = $this->layout()->getVariable('templateDir');

        $wrapper = new AttiConcessioneGetterWrapper( new AttiConcessioneGetter($em) );
        $wrapper->setInput(array('orderBy' => 'atti.id DESC'));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);

        $records = $wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'records'                       => !empty($records) ? $records : null,
            'paginator'                     => $wrapper->getPaginator(),
            'paginator_total_item_count'    => $wrapper->getPaginator()->getTotalItemCount(),
            'templatePartial'               => 'atti-concessione/atti-concessione.phtml',
        ));

        $this->layout()->setTemplate(isset($basicLayout) ? $templateDir.$basicLayout : $mainLayout);
    }
}