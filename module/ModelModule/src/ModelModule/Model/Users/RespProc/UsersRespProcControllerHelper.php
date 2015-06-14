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

        return $this->getConnection()->insert(
            DbTableContainer::usersRespProc,
            array(
                'nome'      => $userId,
                'attivo'    => 1,
            )
        );
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

        return $this->getConnection()->delete(
            DbTableContainer::usersRespProc,
            array(
                'id' => $id,
            )
        );
    }
}
