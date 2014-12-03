<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  30 October 2014
 */
class AlboPretorioArticoliCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_albo_articoli';
    
    protected function insert()
    {
        $this->getConnection()->beginTransaction();
        try {
            $this->getConnection()->insert($this->tableName, array(
                'utente_id'             => $this->rawPost['utente'],
                'sezione_id'            => $this->rawPost['sezione'],
                'numero_progressivo'    => $this->rawPost['numeroProgressivo'],
                'numero_atto'           => $this->rawPost['numeroAtto'],
                'anno'                  => $this->rawPost['anno'],
                'data_attivazione'      => date("Y-m-d H:i:s"),
                'ora_attivazione'       => date("H:i:s"),
                'data_pubblicare'       => date("Y-m-d H:i:s"),
                'ora_pubblicare'        => date("H:i:s"),
                'scadenza'              => $this->rawPost['scadenza'],
                'data_pubblicare'       => date("Y-m-d H:i:s"),
                'titolo'                => $this->rawPost['titolo'],
                'pubblicare'            => $this->rawPost['pubblicare'],
                'annullato'             => $this->rawPost['annullato'],
                'rettifica_id'          => $this->rawPost['rettificaId'],
                'data_invio_regione'    => date("Y-m-d H:i:s"),
                'num_att'               => $this->rawPost['num_att'],
                'check_invia_regione'   => $this->rawPost['check_invia_regione'],
                'anno_atto'             => $this->rawPost['anno_atto'],
                'home'                  => $this->rawPost['home'],
                'ente_terzo'            => $this->rawPost['ente_terzo'],
                'fonte_url'             => $this->rawPost['fonte_url'],
                'note'                  => $this->rawPost['note'],
                'data_rettifica'        => $this->rawPost['data_rettifica'],
                'check_rettifica'       => $this->rawPost['check_rettifica'],
            ));

            $this->getConnection()->commit();

            $this->setVariable('messageType',   'success');
            $this->setVariable('messageTitle',  'Dati inseriti correttamente');
            $this->setVariable('messageText',   'Dati inseriti correttamente in archivio.');
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    protected function update()
    {
        $this->getConnection()->beginTransaction();
        try {
            $this->setArrayRecordToHandle('titolo', 'titolo');
            $this->setArrayRecordToHandle('utente_id', 'utente');
            $this->setArrayRecordToHandle('sezione_id', 'sezione');
            $this->setArrayRecordToHandle('numero_progressivo', 'numeroProgressivo');
            $this->setArrayRecordToHandle('numero_atto', 'numeroAtto');
            $this->setArrayRecordToHandle('anno', 'anno');
            $this->setArrayRecordToHandle('data_attivazione', date("Y-m-d H:i:s") );
            $this->setArrayRecordToHandle('ora_attivazione', date("H:i:s") );
            $this->setArrayRecordToHandle('data_pubblicare', date("Y-m-d H:i:s") );
            $this->setArrayRecordToHandle('ora_pubblicare',date("H:i:s") );
            $this->setArrayRecordToHandle('scadenza', 'scadenza');
            $this->setArrayRecordToHandle('data_pubblicare', date("Y-m-d H:i:s") );
            $this->setArrayRecordToHandle('titolo', 'titolo');
            $this->setArrayRecordToHandle('pubblicare', 'pubblicare');
            $this->setArrayRecordToHandle('annullato', 'annullato');
            $this->setArrayRecordToHandle('rettifica_id', 'rettificaId');
            $this->setArrayRecordToHandle('data_invio_regione', date("Y-m-d H:i:s") );
            $this->setArrayRecordToHandle('num_att', 'numAtt');
            $this->setArrayRecordToHandle('check_invia_regione', 'checkInviaRegione');
            $this->setArrayRecordToHandle('anno_atto', 'annoAtto');
            $this->setArrayRecordToHandle('home', 'home');
            $this->setArrayRecordToHandle('ente_terzo', 'enteTerzo');
            $this->setArrayRecordToHandle('fonte_url', 'fonteUrl');
            $this->setArrayRecordToHandle('note', 'note');
            $this->setArrayRecordToHandle('data_rettifica', 'dataRettifica');
            $this->setArrayRecordToHandle('check_rettifica', 'checkRettifica');

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
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    protected function delete()
    {
        
    }
}

