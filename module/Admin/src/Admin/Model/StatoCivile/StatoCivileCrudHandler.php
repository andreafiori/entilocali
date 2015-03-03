<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  30 October 2014
 */
class StatoCivileCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_stato_civile_articoli';

    /**
     * @throws \Doctrine\DBAL\ConnectionException
     */
    protected function insert()
    {
        $userDetails = $this->getInput('userDetails',1);

        $this->getConnection()->beginTransaction();
        try {
            $this->getConnection()->insert($this->tableName, array(
                'titolo'                => $this->rawPost['titolo'],
                'progressivo'           => (isset($this->rawPost['numeroProgressivo'])) ? $this->rawPost['numeroProgressivo'] : 0,
                'anno'                  => date("Y"),
                'data'                  => date("Y-m-d"),
                'ora'                   => date("H:i:s"),
                'attivo'                => $this->rawPost['attivo'],
                'scadenza'              => $this->rawPost['scadenza'],
                'flag_allegati'         => 0,
                'utente_id'             => $userDetails->id,
                'sezione_id'            => $this->rawPost['sezione'],
            ));

            $this->getConnection()->commit();

            $this->setSuccessMessage();
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }

    /**
     * @throws \Doctrine\DBAL\ConnectionException
     */
    protected function update()
    {
        $this->getConnection()->beginTransaction();
        try {
            $this->setArrayRecordToHandle('titolo', 'utente', 'sezione');

            $this->getConnection()->update($this->tableName, 
                    $this->getArrayRecordToHandle(),
                    array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            $this->setSuccessMessage();
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
}