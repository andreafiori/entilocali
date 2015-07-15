<?php

namespace ModelModule\Model\Users\RespProc;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;

class UsersRespProcControllerHelper extends ControllerHelperAbstract
{
    /**
     * Insert utente responsabile procedimento
     *
     * @param int $userId
     * @return int
     */
    public function insert($userId)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::usersRespProc,
            array(
                'user_id'   => $userId,
                'attivo'    => 1,
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Delete utente responsabile procedimento
     *
     * @param int $id
     * @return int
     */
    public function delete($id)
    {
        $this->assertConnection();

        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
        $this->getConnection()->delete(
            DbTableContainer::usersRespProc,
            array('id' => $id),
            array('limit'=> 1)
        );
        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');

        return true;
    }
}
