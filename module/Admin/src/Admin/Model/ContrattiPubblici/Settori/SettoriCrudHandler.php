<?php

namespace Admin\Model\ContrattiPubblici\Settori;

use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class SettoriCrudHandler extends CrudHandlerAbstract
{
    private $tableName = 'zfcms_comuni_contratti_settori';

    public function insert()
    {
        $this->getConnection()->beginTransaction();
        try {
            // Validate
            $error = array();

            $varsToCheck = array('nome', 'responsabile', 'attivo');
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
                'nome'          => $this->rawPost['nome'],
                'responsabile'  => $this->rawPost['responsabile'],
                'attivo'        => $this->rawPost['attivo'],
            ));
            $this->getConnection()->commit();

            // Log
            $userDetails  = $this->getInput('userDetails', 1);

            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => '12',
                'message'   => $userDetails->name.' '.$userDetails->surname."' ha inserito il settore enti pubblici ".$this->rawPost['nome'],
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
            // Validate input
            $error = array();

            $varsToCheck = array('nome', 'responsabile', 'attivo');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }

            $this->setArrayRecordToHandle('nome', 'nome');
            $this->setArrayRecordToHandle('responsabile', 'responsabile');
            $this->setArrayRecordToHandle('attivo', 'attivo');

            // Update
            $this->getConnection()->update($this->tableName,
                $this->getArrayRecordToHandle(),
                array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            // Log
            $userDetails  = $this->getInput('userDetails', 1);

            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => 6,
                'message'   => $userDetails->name.' '.$userDetails->surname."' ha aggiornato il settore contratti pubblici ".$this->rawPost['nome'],
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
            return $this->setErrorMessage($e->getMessage());
        }

        return true;
    }
}