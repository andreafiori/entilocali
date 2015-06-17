<?php

namespace Admin\Controller\Posts;

use ModelModule\Model\Posts\PostsCategoriesControllerHelper;
use ModelModule\Model\Posts\PostsCategoriesGetter;
use ModelModule\Model\Posts\PostsCategoriesGetterWrapper;
use Application\Controller\SetupAbstractController;

class PostsCategoriesSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $entityManager  = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lang               = $this->params()->fromRoute('lang');
        $languageSelection  = $this->params()->fromRoute('languageSelection');
        $page               = $this->params()->fromRoute('page');
        $moduleCode         = $this->params()->fromRoute('moduleCode');

        $helper = new PostsCategoriesControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new PostsCategoriesGetterWrapper(new PostsCategoriesGetter($entityManager)),
            array(
                "moduleCode"            => $moduleCode,
                'languageAbbreviation'  => $languageSelection
            ),
            $page,
            null
        );
        $records = $wrapper->setupRecords();

        $columnRecords = array();
        foreach($records as $record) {
            $columnRecords[] = array(
                $record['name'],
                $record['createDate'],
                array(
                    'type' => 'updateButton',
                    'href' => $this->url()->fromRoute('admin/posts-categories-form', array(
                        'lang'              => $this->params()->fromRoute('lang'),
                        'languageSelection' => $this->params()->fromRoute('languageSelection'),
                        'previouspage'      => $this->params()->fromRoute('page'),
                        'formtype'          => $this->params()->fromRoute('moduleCode'),
                        'id'                => $record['id'],
                    )),
                    'title' => 'Modifica categoria'
                ),
                array(
                    'type'      => 'deleteButton',
                    'href'      => '#',
                    'data-id'   => $record['id'],
                    'title'     => 'Elimina'
                )
            );
        }

        $this->layout()->setVariables(array(
                'tableTitle' => 'Categorie ',
                'tableDescription' => $wrapper->getPaginator()->getTotalItemCount().' categorie in archivio',
                'columns' => array(
                    "Nome",
                    "Data creazione",
                    "&nbsp;",
                    "&nbsp;"
                ),
                'paginator'         => $wrapper->getPaginator(),
                'records'           => $columnRecords,
                'formBreadCrumbCategory' => array(
                    array(
                        'label' => $helper->recoverLabelByModuleCode($moduleCode),
                        'href'  =>  $this->url()->fromRoute($helper->recoverRouteByModuleCode($moduleCode),
                            array(
                                'lang' => $lang,
                                'languageSelection' => $languageSelection,
                            )
                        ),
                        'title' => $helper->recoverLabelByModuleCode($moduleCode),
                    ),
                ),
                'templatePartial'   => self::summaryTemplate
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}