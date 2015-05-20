<?php

namespace Application\Controller\Posts;

use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
use Application\Controller\SetupAbstractController;

class PhotoController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');

        //$category   = $this->params()->fromRoute('category');

        $wrapper = new PostsGetterWrapper( new PostsGetter($em) );
        $wrapper->setInput(array(
            'moduleCode'        => 'photo',
            //'categorySlug'    => $category,
            'orderBy'           => 'p.id DESC',
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage($page);
        $wrapper->setupPaginatorItemsPerPage(null);
        $wrapper->setEntityManager($em);

        $paginator = $wrapper->getPaginator();

        $records = $wrapper->addAttachmentsToPaginatorRecords($wrapper->setupRecords(), array());

        $this->layout()->setVariables(array(
                'records'           => $records,
                'paginator'         => $paginator,
                'item_count'        => $paginator->getTotalItemCount(),
                //'category'          => $category,
                //'formSearch'        => $formSearch,
                //'categoryName'      => Slugifier::deSlugify($category),
                'templatePartial'   => 'posts/photo/list.phtml'
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}