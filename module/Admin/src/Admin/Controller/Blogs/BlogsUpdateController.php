<?php

namespace Admin\Controller\Blogs;

use Application\Controller\SetupAbstractController;

class BlogsUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $this->layout()->setTemplate($mainLayout);
    }
}