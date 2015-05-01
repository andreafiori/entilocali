<?php

namespace Application\Controller\Posts;

use Application\Controller\SetupAbstractController;

/**
 * Blog and posts contents summary and details
 *
 * @author Andrea Fiori
 * @since  15 April 2015
 */
class BlogContentsController extends SetupAbstractController
{
    /*
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $category = $this->getInput('category', 1);

        $title = $this->getInput('title', 1);

        $param = $this->getInput('param', 1);

        $postsGetterWrapper = new PostsGetterWrapper(new PostsGetter($this->getInput('entityManager', 1)));
        $postsGetterWrapper->setInput($this->getInput());
        $postsGetterWrapper->setupQueryBuilder();
        $postsGetterWrapper->setupPaginator( $postsGetterWrapper->setupQuery($this->getInput('entityManager', 1)) );
        $postsGetterWrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );

        $records = $postsGetterWrapper->setupRecords();

        $this->setVariables(array(
                'paginator'     => $records,
                'category'      => '',
                'category_seo'  => '',
                'title'         => '',
                'title_seo'     => '',
            )
        );

        $this->layout()->setVariables(array(
            'templatePartial' => ''
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    public function details()
    {

    }
    */
}