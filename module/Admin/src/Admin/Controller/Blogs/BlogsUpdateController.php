<?php

namespace Admin\Controller\Blogs;

use Application\Controller\SetupAbstractController;

class BlogsUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        // TODO: check if categories is empy... update posts, update categories (delete old or check categories and add\delete to match the selection)

        $this->layout()->setTemplate($mainLayout);
    }
}