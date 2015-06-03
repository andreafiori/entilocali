<?php

namespace Admin\Controller\Photo;

use Application\Controller\SetupAbstractController;

/**
 * TODO: upload image, resize thumb, rename with uid insert into posts, relations, log operation
 */
class PhotoInsertController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if ($request->isXmlHttpRequest() or $request->isPost()) {

        }

        $this->layout()->setTemplate($mainLayout);
    }
}