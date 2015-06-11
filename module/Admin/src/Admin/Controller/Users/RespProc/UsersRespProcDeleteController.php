<?php

namespace Admin\Controller\Users\RespProc;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;

/**
 * TODO: delete user resp. proc., log operation, redirect...
 */
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

        if (!($request->isXmlHttpRequest() or $request->isPost())) {
            return $this->redirect()->toRoute('main');
        }

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        $userDetails = $this->recoverUserDetails();

        $connection->beginTransaction();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $connection->delete(
            DbTableContainer::usersRespProc,
            array('id' => $post['deleteId']),
            array('limit'=> 1)
        );
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $connection->commit();

        return $this->redirect()->toRoute('admin/users-resp-proc-management', array(
            'lang' => $this->params()->fromRoute('lang')
        ));
    }
}
