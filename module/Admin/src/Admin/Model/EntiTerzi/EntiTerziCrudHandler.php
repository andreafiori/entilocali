<?php

namespace Admin\Model\EntiTerzi;

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
        try {
            $this->getConnection()->beginTransaction();
            $this->getConnection()->insert($this->tableName, array(
                'nome'      => $this->rawPost['nome'],
                'email'     => $this->rawPost['email'],
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

            $this->setSuccessMessage();
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
}
