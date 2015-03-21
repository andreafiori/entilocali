<?php

namespace Admin\Model\ContrattiPubblici\SceltaContraente;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class SceltaContraenteCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_contratti_sc_contr';
    
    public function insert()
    {
        $this->getConnection()->beginTransaction();
        try {
            // Validate
            $error = array();

            $varsToCheck = array('nomeScelta', 'attivo');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }

            if (!empty($error)) {
                $this->setErrorMessage($error);
                return false;
            }

            // Insert into db
            $this->getConnection()->insert($this->tableName, array(
                'nome_scelta'      => $this->rawPost['nomeScelta'],
                'attivo'     => $this->rawPost['attivo'],
            ));
            $this->getConnection()->commit();

            // Log
            $userDetails  = $this->getInput('userDetails', 1);

            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => '12',
                'message'   => $userDetails->name.' '.$userDetails->surname."' ha inserito una nuova voce di scelta contraente ".$this->rawPost['nomeScelta'],
                'type'      => 'info',
                'backend'   => 1,
            ));

            if ($logResult!=1) {
                $this->setSuccessMessage('Dati salvati correttamente', 'Dati salvati correttamente, ma attenzione: il log non &egrave; stato scritto nel registro. Errore: '.$logResult, 'warning');
            } else {
                $this->setSuccessMessage();
            }

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            $errorMessage = $e->getMessage();

            // Log
            $userDetails  = $this->getInput('userDetails', 1);

            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => 12,
                'message'   => $userDetails->name.' '.$userDetails->surname."', errore durante l'aggiornamento dell'ente terzo ".$this->rawPost['nome'].' Messaggio: '.$errorMessage,
                'type'      => 'error',
                'backend'   => 1,
            ));

            return $this->setErrorMessage($errorMessage);
        }

        return true;
    }
    
    public function update()
    {
        $this->getConnection()->beginTransaction();
        try {
            $error = array();

            $varsToCheck = array('nomeScelta', 'attivo');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }
        
            $this->setArrayRecordToHandle('nome_scelta', 'nomeScelta');
            $this->setArrayRecordToHandle('attivo', 'attivo');

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
