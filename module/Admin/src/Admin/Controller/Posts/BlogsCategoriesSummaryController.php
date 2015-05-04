<?php

namespace Admin\Controller\Posts;

use Admin\Model\Posts\CategoriesGetter;
use Admin\Model\Posts\CategoriesGetterWrapper;
use Application\Controller\SetupAbstractController;

class BlogsCategoriesSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $entityManager  = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');

        $moduleCode = $this->params()->fromRoute('moduleCode');

        $wrapper = new CategoriesGetterWrapper( new CategoriesGetter($entityManager) );
        $wrapper->setInput(array(
            "moduleCode" => $moduleCode,
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator($wrapper->setupQuery($entityManager));
        $wrapper->setupPaginatorCurrentPage(isset($page) ? $page : null);

        $records = $wrapper->setupRecords();

        $columnRecords = array();
        foreach($records as $record) {
            $columnRecords[] = array(
                $record['name'],
                $record['createDate'],
                ucfirst($record['status']),
                array(
                    'type'      => 'updateButton',
                    'href'      => 'formdata/categories/',
                    'title'     => 'Modifica'
                ),
                array(
                    'type'      => 'deleteButton',
                    'href'      => '#',
                    'title'     => 'Elimina',
                    'data-id'   => $record['id']
                ),
            );
        }

        $this->layout()->setVariables(array(
                'tableTitle' => 'Categorie ',
                'tableDescription'  => $wrapper->getPaginator()->getTotalItemCount().' categorie in archivio',
                'columns' => array(
                    "Nome",
                    "Data creazione",
                    "Stato",
                    "&nbsp;",
                    "&nbsp;"
                ),
                'paginator'         => $wrapper->getPaginator(),
                'records'           => $columnRecords,
                'templatePartial'   => self::summaryTemplate
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}