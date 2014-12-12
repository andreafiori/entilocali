<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class ResponsabiliProcedimentoCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_contratti_resp_proc';
    
    public function insert()
    {
        try {
            $error = array();
            
            $varsToCheck = array('nomeResp');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }
                        
            if ($error) {
                $this->setErrorMessage($error);
            } else {
                $this->getConnection()->beginTransaction();
                $this->getConnection()->insert($this->tableName, array(
                    'nome_resp' => $this->rawPost['nomeResp'],
                ));

                $this->getConnection()->commit();

                $this->setVariable('redirectRoute', 1);
                $this->setVariable('redirectRouteTableSetter', 'contratti-pubblici-responsabili');
                
                $this->setSuccessMessage();
            }
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    public function update()
    {  
        try {
            $error = array();

            $varsToCheck = array('nomeResp');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }
        
            $this->setArrayRecordToHandle('nome_resp', 'nomeResp');

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
    
    public function delete()
    {
        
    }
}