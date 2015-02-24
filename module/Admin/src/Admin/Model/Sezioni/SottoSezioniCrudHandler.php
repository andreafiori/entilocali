<?php

namespace Admin\Model\Sezioni;

use Admin\Model\FormData\CrudHandlerAbstract;
use Application\Model\Slugifier;

/**
 * @author Andrea Fiori
 * @since  17 February 2014
 */
class SottoSezioniCrudHandler extends CrudHandlerAbstract
{
    private $tableName = 'zfcms_comuni_sottosezioni';

    public function insert()
    {
        $userDetails  = $this->getInput('userDetails', 1);

        $this->getConnection()->beginTransaction();
        try {

            $this->getConnection()->insert($this->tableName, array(
                'nome'              => $this->rawPost['nomeSezione'],
                'sezione_id'        => $this->rawPost['sezione'],
                //'immagine'        => $this->rawPost['immagine'],
                'url'               => $this->rawPost['url'],
                'url_title'         => $this->rawPost['urlTitle'],
                'posizione'         => $this->rawPost['posizione'],
                'attivo'            => $this->rawPost['attivo'],
                'profondita_da'     => 0,
                'profondita_a'      => '',
                'slug'              => Slugifier::slugify($this->rawPost['nomeSezione']),
                'utente_id'         => $userDetails->id,
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
                'module_id' => 2,
                'message'   => $userDetails->name.' '.$userDetails->surname."', errore durante l'inserimento della sotto-sezione ".$this->rawPost['nomeSezione'].' Messaggio: '.$errorMessage,
                'type'      => 'error',
                'backend'   => 1,
            ));

            return $this->setErrorMessage($errorMessage);
        }
    }

    public function update()
    {
        $this->setArrayRecordToHandle('nome', 'nomeSezione');
        $this->setArrayRecordToHandle('posizione', 'posizione');
        $this->setArrayRecordToHandle('attivo', 'attivo');
        $this->setArrayRecordToHandle('sezione_id', 'sezione');
        $this->setArrayRecordToHandle('url', 'url');
        $this->setArrayRecordToHandle('url_title', 'urlTitle');

        $this->setArrayRecordElement('slug', Slugifier::slugify($this->rawPost['nomeSezione']));

        $userDetails  = $this->getInput('userDetails', 1);

        $this->getConnection()->beginTransaction();
        try {

            $affectedRows = $this->getConnection()->update(
                $this->tableName, $this->getArrayRecordToHandle(), array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            $this->setSuccessMessage();

            // Log
            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => 2,
                'message'   => $userDetails->name.' '.$userDetails->surname."', ha aggiornato la sotto-sezione ".$this->rawPost['nomeSezione'],
                'type'      => 'info',
                'backend'   => 1,
            ));

        } catch(\Exception $e) {
            $this->getConnection()->rollBack();

            // Log
            $errorMessage = $e->getMessage();

            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => 2,
                'message'   => $userDetails->name.' '.$userDetails->surname."', errore durante l'aggiornamento della sotto-sezione ".$this->rawPost['nomeSezione'].' Messaggio: '.$errorMessage,
                'type'      => 'error',
                'backend'   => 1,
            ));

            return $this->setErrorMessage($errorMessage);
        }
    }
}
