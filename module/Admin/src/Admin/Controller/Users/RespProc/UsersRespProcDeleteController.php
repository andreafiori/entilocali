<?php

namespace Admin\Controller\Users\RespProc;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Users\RespProc\UsersRespProcControllerHelper;

class UsersRespProcDeleteController extends SetupAbstractController
{
    public function indexAction()
    {
        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        /**
         * @var \Doctrine\DBAL\Connection $connection
         */
        $connection = $em->getConnection();

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->redirect()->toRoute('main');
        }

        $post = $request->getPost()->toArray();

        $userDetails = $this->recoverUserDetails();

        $helper = new UsersRespProcControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();
        $helper->delete($post['deleteId']);
        $helper->getConnection()->commit();

        return $this->redirect()->toRoute('admin/users-responsabili-procedimento', array(
            'lang' => $this->params()->fromRoute('lang')
        ));
    }
}
