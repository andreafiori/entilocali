<?php

namespace Admin\src\Admin\Controller\Users\RespProc;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;

class UsersRespProcOperationsController extends SetupAbstractController
{
    public function insertAction()
    {
        /*
        $connection->insert(
            DbTableContainer::usersRespProc,
            array(
                'user_id' => $param['post']['user'],
                'attivo'  => 1,
            )
        );

        return redirect....
        */
    }

    public function deleteAction()
    {
        $connection->beginTransaction();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $connection->delete(
            DbTableContainer::usersRespProc,
            array('id' => $param['post']['deleteId']),
            array('limit'=>1)
        );
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $connection->commit();
    }
}
