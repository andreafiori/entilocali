<?php

namespace Admin\Model\Users;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  27 June 2014
 */
class UsersCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $usersTable = 'zfcms_users';

    public function insert()
    {

    }

    public function update()
    {
        $this->setArrayRecordToHandle('name', 'name');
        $this->setArrayRecordToHandle('surname', 'surname');
        $this->setArrayRecordToHandle('username', 'username', 1);

        if ($this->rawPost['password'] != $this->rawPost['password-confirm']) {
            $this->setErrorMessage('Le due password non coincidono');
            return false;
        } else {
            // encrypt md5 pass (temporary)
            $this->setArrayRecordElement('password', md5($this->rawPost['password']));
        }

        $this->getConnection()->beginTransaction();
        try {
            $affectedRows = $this->getConnection()->update(
                $this->usersTable,
                $this->getArrayRecordToHandle(),
                array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            $this->setSuccessMessage();

        } catch(\Exception $e) {
            $this->getConnection()->rollBack();

            return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
        }
    }
}
