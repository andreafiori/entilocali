<?php

namespace Admin\Controller\Blogs;

use Application\Controller\SetupAbstractController;

/**
 * TODO:
 *      validate data
 *      insert into posts, insert into posts_relations,
 *      upload image resizing
 *      log operation
 *      show messages OK or error
 *          delete crudhandler object
 */
class BlogsInsertController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $this->layout()->setTemplate($mainLayout);
    }
}