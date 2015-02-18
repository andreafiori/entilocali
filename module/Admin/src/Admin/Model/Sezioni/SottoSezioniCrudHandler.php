<?php

namespace Admin\Model\Sezioni;

use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  17 February 2014
 */
class SottoSezioniCrudHandler extends CrudHandlerAbstract
{
    public function insert()
    {

    }

    public function update()
    {
        $this->setArrayRecordToHandle('name', 'name');

        $this->getConnection()->beginTransaction();
        try {
            /*
            $affectedRows = $this->getConnection()->update(
                $this->usersTable, $this->getArrayRecordToHandle(), array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            */
            $this->setSuccessMessage();
        } catch(\Exception $e) {
            $this->getConnection()->rollBack();

            return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
        }
    }
}