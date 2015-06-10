<?php

namespace Admin\Controller\Users\RespProc;

use Application\Controller\SetupAbstractController;

/**
 * TODO: delete user resp. proc., log operation, redirect...
 */
class UsersRespProcDeleteController extends SetupAbstractController
{
    public function indexAction()
    {
        /*
        $connection = $this->getInput('entityManager',1)->getConnection();
        $connection->beginTransaction();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $connection->delete(
            DbTableContainer::usersRespProc,
            array('id' => $param['post']['deleteId']),
            array('limit'=>1)
        );
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $connection->commit();
        */
    }
}
