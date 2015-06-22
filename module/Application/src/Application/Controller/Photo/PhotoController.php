<?php

namespace Application\Controller\Photo;

use ModelModule\Model\Posts\PostsCategoriesGetter;
use ModelModule\Model\Posts\PostsCategoriesGetterWrapper;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use Application\Controller\SetupAbstractController;

class PhotoController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page = $this->params()->fromRoute('page');

        $configurations = $this->layout()->getVariable('configurations');
        $directoryThumb = $configurations['media_dir'].$configurations['media_project'].'photo/thumbs/';
        $directoryBig = $configurations['media_dir'].$configurations['media_project'].'photo/big/';

        $helper = new PostsControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new PostsGetterWrapper(new PostsGetter($em)),
            array(
                'moduleCode' => 'photo',
                'orderBy'    => 'p.id DESC',
            ),
            $page,
            null
        );
        $categoriesRecords = $helper->recoverWrapperRecords(
            new PostsCategoriesGetterWrapper(new PostsCategoriesGetter($em)),
            array('moduleCode' => 'photo', 'orderBy' => 'category.name', 'fields' => 'category.id, category.name')
        );

        $paginator = $wrapper->getPaginator();

        $records =$wrapper->setupRecords();

        $this->layout()->setVariables(array(
            'directoryThumb'        => $directoryThumb,
            'directoryBig'          => $directoryBig,
            'records'               => $records,
            'paginator'             => $paginator,
            'item_count'            => $paginator->getTotalItemCount(),
            'templatePartial'       => 'posts/photo/list.phtml'
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    public function details()
    {

    }
}