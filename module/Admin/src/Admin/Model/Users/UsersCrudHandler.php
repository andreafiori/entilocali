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
    public function performOperation()
    {
        $operation = $this->getOperation();
        if ($operation) {
            $this->$operation();
        }
    }
    
        private function insert()
        {
            
        }
        
        private function update()
        {
            $this->setArrayRecordToHandle('name', 'name');
            $this->setArrayRecordToHandle('surname', 'surname');

            if ($this->rawPost['password'] != $this->rawPost['password-confirm']) {
                $this->setVariable('messageType', 'danger');
                $this->setVariable('messageTitle', 'Errore');
                $this->setVariable('messageText', 'Le due password non coincidono');
                return;
            }
            
            $this->getConnection()->beginTransaction();
            try {
                $affectedRows = $this->getConnection()->update(
                    'zfcms_users', $this->getArrayRecordToHandle(), array('id' => $this->rawPost['id'])
                );
            $this->setVariable('messageType', 'success');
            $this->setVariable('messageTitle', 'Dati aggiornati correttamente');
            $this->setVariable('messageText', 'Dati in archivio aggiornati correttamente');
            
            } catch(\Exception $e) {
                $this->getConnection()->rollBack();
                return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
            }
            
            $this->getConnection()->commit();
        }
}