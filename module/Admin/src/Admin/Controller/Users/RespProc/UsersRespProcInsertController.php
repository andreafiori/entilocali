<?php

namespace Admin\Controller\Users\RespProc;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Log\LogWriter;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Users\RespProc\UsersRespProcControllerHelper;

/**
 *  Responsabile Procedimento Insert Controller
 */
class UsersRespProcInsertController extends SetupAbstractController
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

        $helper = new UsersRespProcControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();
        $lastInsertId =$helper->insert($post['user']);
        $helper->getConnection()->commit();

        $logWriter = new LogWriter($connection);
        $logWriter->writeLog(array(
            'user_id'       => $userDetails->id,
            'module_id'     => ModulesContainer::atti_concessione,
            'message'       => "Inserito nuovo responsabile di procedimento, utente ".$userDetails->id,
            'type'          => 'info',
            'reference_id'  => $lastInsertId,
            'backend'       => 1,
        ));

        return $this->redirect()->toRoute('admin/users-responsabili-procedimento', array(
            'lang' => $this->params()->fromRoute('lang')
        ));
    }
}
