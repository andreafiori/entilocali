<?php

namespace Admin\Controller\Users\RespProc;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Log\LogWriter;

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

        $helper = new Respproc();

        $connection->insert(
            DbTableContainer::usersRespProc,
            array(
                'user_id' => $post['user'],
                'attivo'  => 1,
            )
        );

        $logWriter = new LogWriter($connection);
        $logWriter->writeLog(array(
            'user_id'       => $userDetails->id,
            'module_id'     => ModulesContainer::contenuti_id,
            'message'       => "Inserito nuovo responsabile di procedimento, utente ".$userDetails->id,
            'type'          => 'info',
            'backend'       => 1,
        ));

        return $this->redirect()->toRoute('admin/users-resp-proc-management', array(
            'lang' => $this->params()->fromRoute('lang')
        ));
    }
}
