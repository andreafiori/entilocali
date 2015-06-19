<?php

namespace Application\Controller\Photo;

use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use Application\Controller\SetupAbstractController;

class PhotoController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');

        $wrapper = new PostsGetterWrapper( new PostsGetter($em) );
        $wrapper->setInput(array(
            'moduleCode'    => 'photo',
            'orderBy'       => 'p.id DESC',
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
                'templatePartial'   => 'posts/photo/list.phtml'
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}