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
            $error = array();
            
            $varsToCheck = array('userId', 'sezione', 'numeroAtto', 'anno', 'dataScadenza', 'titolo');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }
            
            if (!empty($error)) {
                $this->setErrorMessage($error);
                return;
            }
            
            if (!$this->rawPost['numeroAtto']) {
                $error[] = 'Numero atto non &egrave; un numero';
            }
            
            if ( (int)$this->rawPost['anno'] > 2030 or (int)$this->rawPost['anno'] < 1954 ) {
                $error[] = 'Anno atto deve essere un anno valido.';
            }
            
            if ($error) {
                $this->setErrorMessage($error);
            } else {
                
                $this->getConnection()->insert($this->tableName, array(
                    'utente_id'             => $this->rawPost['userId'],
                    'sezione_id'            => $this->rawPost['sezione'],
                    //'numero_progressivo'    => $this->rawPost['numeroProgressivo'],
                    'numero_atto'           => $this->rawPost['numeroAtto'],
                    'anno'                  => $this->rawPost['anno'],
                    'data_attivazione'      => date("Y-m-d H:i:s"),
                    'ora_attivazione'       => date("H:i:s"),
                    'data_pubblicare'       => date("Y-m-d H:i:s"),
                    'ora_pubblicare'        => date("H:i:s"),
                    'data_scadenza'         => $this->rawPost['dataScadenza'],
                    'data_pubblicare'       => date("Y-m-d H:i:s"),
                    'titolo'                => $this->rawPost['titolo'],
                    'pubblicare'            => 0,
                    'annullato'             => 0,
                    'check_invia_regione'   => isset($this->rawPost['checkInviaRegione']) ? $this->rawPost['checkInviaRegione'] : 0,
                    'anno_atto'             => date("Y"),
                    'ente_terzo'            => $this->rawPost['enteTerzo'],
                    'fonte_url'             => $this->rawPost['fonteUrl'],
                ));

                $this->getConnection()->commit();

                $this->setVariable('redirectRoute', 1);
                $this->setVariable('redirectRouteTableSetter', 'albo-pretorio');
                
                $this->setSuccessMessage('Atto inserito correttamente');
            }
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    protected function update()
    {
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
            
            $this->getConnection()->beginTransaction();
            $this->getConnection()->update($this->tableName, 
                    $this->getArrayRecordToHandle(),
                    array('id' => $this->rawPost['id'])
            );

            $this->getConnection()->commit();

            $this->setSuccessMessage('Atto aggiornato correttamente');
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    protected function delete()
    {
        // TODO: delete article, delete attachments, delete from home
    }
}

