<?php

namespace Application\Controller\Posts;

use Application\Controller\SetupAbstractController;

class PhotoController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');

        $category   = $this->params()->fromRoute('category');

        $this->layout()->setVariables(array(
                'templatePartial'   => 'posts/photo/list.phtml'
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }
}