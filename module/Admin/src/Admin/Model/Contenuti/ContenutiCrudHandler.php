<?php

namespace Admin\Model\Contenuti;

use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  15 February 2015
 */
class ContenutiCrudHandler extends CrudHandlerAbstract
{
    private $tableName = 'zfcms_comuni_contenuti';

    protected function insert()
    {
        $userDetails  = $this->getInput('userDetails', 1);

        $this->getConnection()->beginTransaction();
        try {
            $this->getConnection()->insert($this->tableName, array(
                'titolo'           => $this->rawPost['titolo'],
                'anno'             => date("Y"),
                'numero'           => 0,
                'sommario'         => $this->rawPost['sommario'],
                'testo'            => $this->rawPost['sommario'],
                'data_inserimento' => $this->rawPost['dataInserimento'],
                'data_scadenza'    => $this->rawPost['dataScadenza'],
                'attivo'           => $this->rawPost['attivo'],
                'sottosezione_id'  => $this->rawPost['sottosezione'],
                'home' => isset($this->rawPost['home']) ? $this->rawPost['home'] : 0,
                'evidenza'         => isset($this->rawPost['evidenza']) ? $this->rawPost['evidenza'] : 0,
                'utente_id'        => $userDetails->id,
                /*
                'rss' => $this->rawPost['rss'],
                'slug' => $this->rawPost['titolo'],
                'seo_title' => $this->rawPost['seoTitle'],
                'seo_description' => $this->rawPost['seoDescription'],
                'seo_keywords' => $this->rawPost['seo_keywords'],
                */
            ));

            $this->getConnection()->commit();

            $this->setSuccessMessage();

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();

            // Log
            $errorMessage = $e->getMessage();

            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => '2',
                'message'   => $userDetails->name.' '.$userDetails->surname."', errore durante l'inserimento della sezione ".$this->rawPost['nome'].' Messaggio: '.$errorMessage,
                'type'      => 'error',
                'backend'   => 1,
            ));

            return $this->setErrorMessage($errorMessage);
        }
    }

    protected function update()
    {
        $this->getConnection()->beginTransaction();
        try {
            $error = array();

            $varsToCheck = array('titolo', 'testo', 'dataInserimento', 'dataScadenza', 'attivo');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }

            if (!empty($error)) {
                $this->setErrorMessage($error);
                return;
            }

            $this->setArrayRecordToHandle('sottosezione_id', 'sottosezione');
            $this->setArrayRecordToHandle('titolo', 'titolo');
            $this->setArrayRecordToHandle('sommario', 'sommario');
            $this->setArrayRecordToHandle('testo', 'testo');
            $this->setArrayRecordToHandle('data_inserimento', 'dataInserimento');
            $this->setArrayRecordToHandle('data_scadenza', 'dataScadenza');
            $this->setArrayRecordToHandle('attivo', 'attivo');

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