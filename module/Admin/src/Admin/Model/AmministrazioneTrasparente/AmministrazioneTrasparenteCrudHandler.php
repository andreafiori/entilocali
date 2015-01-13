<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  16 December 2014
 */
class AmministrazioneTrasparenteCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_contenuti';
    
    public function insert()
    {
        try {
            $error = array();
            
            $varsToCheck = array('anno', 'numero', 'titolo', 'testo');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }
            
            if (!empty($error)) {
                $this->setErrorMessage($error);
                return;
            }
            
            if ( (int)$this->rawPost['anno'] > 2030 or (int)$this->rawPost['anno'] < 1954 ) {
                $error[] = 'Anno atto deve essere un anno valido.';
            }
            
            if ($error) {
                $this->setErrorMessage($error);
            } else {
                /*
                $this->getConnection()->beginTransaction();
                $this->getConnection()->insert($this->tableName, array(
                    'utente_id' => $this->rawPost['userId'],
                ));

                $this->getConnection()->commit();

                $this->setVariable('redirectRoute', 1);
                $this->setVariable('redirectRouteTableSetter', 'amministrazione-trasparente');
                
                $this->setSuccessMessage('Articolo inserito correttamente');
                */
            }
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    public function update()
    {
        
    }
    
    public function delete()
    {
        
    }
}