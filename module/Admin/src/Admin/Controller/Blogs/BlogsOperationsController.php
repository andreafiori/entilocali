<?php

namespace Admin\Controller\Blogs;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Posts\PostsFormSearch;
use Zend\Session\Container as SessionContainer;

class BlogsOperationsController extends SetupAbstractController
{
    /**
     * Switch language and redirect to summary
     */
    public function switchlanguageAction()
    {
        if ($this->getRequest()->isPost()) {
            return $this->redirect()->toRoute('admin/blogs-summary', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromPost('lingua'),
                'page'              => $this->params()->fromRoute('page'),
                'modulename'        => $this->params()->fromRoute('formtype'),
            ));
        }

        return $this->redirect()->toRoute('main');
    }

    public function blogsearchAction()
    {
        if ($this->getRequest()->isPost()) {
            $formSearch = new PostsFormSearch();
            // $formSearch->setData();

            $session = new SessionContainer();
            $session->offsetSet('blogsSearchSession', array(
                'text'      => '',
                'category'  => '',
            ));
        }

        return $this->redirect()->toRoute('main');
    }

    public function photosearchAction()
    {
        // TODO: set session searcch for pictures
        if ($this->getRequest()->isPost()) {
            $formSearch = new PostsFormSearch();
            // $formSearch->setData();

            $session = new SessionContainer();
            $session->offsetSet('photoSearchSession', array(
                'text'      => '',
                'category'  => '',
            ));
        }

        return $this->redirect()->toRoute('main');
    }
}