<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class StatoCivileSezioniCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_stato_civile_sezioni';
    
    protected function insert()
    {
        $this->getConnection()->beginTransaction();
        try {
            
            $this->getConnection()->insert($this->tableName, array(
                'nome' => $this->rawPost['nome'],
                'attivo' => $this->rawPost['attivo'],
            ));

            $this->getConnection()->commit();

            $this->setSuccessMessage();
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    protected function update()
    {
        $this->getConnection()->beginTransaction();
        try {
            
            $this->setArrayRecordToHandle('nome', 'nome');
            $this->setArrayRecordToHandle('attivo', 'attivo');
            $this->setArrayRecordToHandle('data_ultimo_aggiornamento', date("Y-m-d H:i:s"));
            
            $this->getConnection()->update($this->tableName,
                    $this->getArrayRecordToHandle(),
                    array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            $this->setSuccessMessage('Sezione stato civile aggiornata');
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    protected function delete()
    {
        // TODO
    }
}
