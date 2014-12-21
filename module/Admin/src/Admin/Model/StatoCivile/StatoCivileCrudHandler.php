<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  30 October 2014
 */
class StatoCivileCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_stato_civile_articoli';
    
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

            $this->setSuccessMessage();
            
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
    
    protected function delete()
    {
        
    }
}