<?php

namespace Application\Controller\Posts;

use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use ModelModule\Model\Posts\PostsFormSearch;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Slugifier;

class BlogsController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');

        $category   = $this->params()->fromRoute('category');

        $formSearch = new PostsFormSearch();
        $formSearch->addCategories(array(
            'News',
            'Eventi',
            'Rassegna stampa',
        ));
        $formSearch->addSubmitButton();

        $wrapper = new PostsGetterWrapper( new PostsGetter($em) );
        $wrapper->setInput(array(
            'moduleCode'        => 'blogs',
            'categorySlug'      => $category,
            'orderBy'           => 'p.id DESC',
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);
        $wrapper->setupPaginatorItemsPerPage(null);
        $wrapper->setEntityManager($em);

        $records = $wrapper->addAttachmentsToPaginatorRecords($wrapper->setupRecords(), array());

        $paginator = $wrapper->getPaginator();

        $this->layout()->setVariables(array(
                'records'           => $records,
                'paginator'         => $paginator,
                'item_count'        => $paginator->getTotalItemCount(),
                'category'          => $category,
                'formSearch'        => $formSearch,
                'categoryName'      => Slugifier::deSlugify($category),
                'templatePartial'   => 'posts/blogs/list.phtml'
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }

    public function detailsAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $category = $this->params()->fromRoute('category');

        $title = $this->params()->fromRoute('title');

        $wrapper = new PostsGetterWrapper( new PostsGetter($em) );
        $wrapper->setInput(array(
            'moduleCode'   => 'blogs',
            'categorySlug' => $category,
            'slug'         => $title,
            'limit'        => 1,
        ));
        $wrapper->setupQueryBuilder();

        $records = $wrapper->getRecords();

        if (!empty($records)) {
            $singleRecord = $records[0];
            $categoryName = $singleRecord['categoryName'];
            $title        = $singleRecord['title'];
        }

        $this->layout()->setVariables(array(
            'categorySlug'      => $category,
            'titleSlug'         => $title,
            'categoryName'      => !empty($categoryName) ? $categoryName : null,
            'title'             => !empty($title) ? $title : null,
            'record'            => !empty($singleRecord) ? $singleRecord : null,
            'templatePartial'   => 'posts/blogs/details.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}