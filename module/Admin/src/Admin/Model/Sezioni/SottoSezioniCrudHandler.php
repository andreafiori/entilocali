<?php

namespace Admin\Model\Sezioni;

use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  17 February 2014
 */
class SottoSezioniCrudHandler extends CrudHandlerAbstract
{
    private $tableName = 'zfcms_comuni_sottosezioni';

    public function insert()
    {
        $this->getConnection()->beginTransaction();
        try {

            $this->getConnection()->insert($this->tableName, array(
                'nome' => $this->rawPost['nome'],
                //'immagine' => $this->rawPost['immagine'],
                'url' => $this->rawPost['url'],
                'posizione' => $this->rawPost['posizione'],
                'attivo' => $this->rawPost['attivo'],
                //'profondita_da' => $this->rawPost['profondita_da'],
                //'profondita_a' => $this->rawPost['profondita_a'],
                //'slug' => $this->rawPost['slug'],
            ));

            $this->getConnection()->commit();

            $this->setSuccessMessage();

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }

    public function update()
    {
        $this->setArrayRecordToHandle('name', 'name');

        $this->getConnection()->beginTransaction();
        try {

            $affectedRows = $this->getConnection()->update(
                $this->tableName, $this->getArrayRecordToHandle(), array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            $this->setSuccessMessage();
        } catch(\Exception $e) {
            $this->getConnection()->rollBack();

            return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
        }
    }
}