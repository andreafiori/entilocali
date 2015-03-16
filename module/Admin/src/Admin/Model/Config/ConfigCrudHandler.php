<?php

namespace Admin\Model\Config;

use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  15 March 2015
 */
class ConfigCrudHandler extends CrudHandlerAbstract
{
    private $tableName = 'zfcms_config';

    public function update()
    {
        $userDetails  = $this->getInput('userDetails', 1);

        $this->getConnection()->beginTransaction();
        try {
            $error = array();

            $varsToCheck = array('sitename', 'description', 'keywords',);
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }

            if (!empty($error)) {
                $this->setErrorMessage($error);
                return false;
            }

            /*
            $this->getConnection()->update($this->tableName,
                $this->getArrayRecordToHandle(),
                array('name' => $this->rawPost['name'])
            );

            $this->getConnection()->commit();
            */
            $this->setSuccessMessage();

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();

            // Log
            $errorMessage = $e->getMessage();

            $logsWriter = $this->getLogsWriter();
            $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => 2,
                'message'   => $userDetails->name.' '.$userDetails->surname."', errore durante l'inserimento del contenuto ".$this->rawPost['nome'].' Messaggio: '.$errorMessage,
                'type'      => 'error',
                'backend'   => 1,
            ));

            return $this->setErrorMessage($errorMessage);
        }
    }
}