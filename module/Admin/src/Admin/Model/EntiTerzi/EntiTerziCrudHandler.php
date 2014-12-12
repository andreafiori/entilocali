<?php

namespace Admin\Model\Entiterzi;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class EntiTerziCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_rubrica_enti_terzi';
    
    protected function insert()
    {
        
    }
    
    protected function update()
    {
        try {
            $error = array();

            $varsToCheck = array('nome', 'email');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }

            $this->setArrayRecordToHandle('nome', 'nome');
            $this->setArrayRecordToHandle('email', 'email');

            $this->getConnection()->beginTransaction();
            $this->getConnection()->update($this->tableName,
                    $this->getArrayRecordToHandle(),
                    array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            $this->setVariables(array(
                'messageType' => 'success'
            ));
            $this->setVariable('messageTitle', 'Dati aggiornati correttamente');
            $this->setVariable('messageText',  'Dati aggiornati correttamente in archivio.');
            $this->setVariable('messageShowFormLink', 1);
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
}
