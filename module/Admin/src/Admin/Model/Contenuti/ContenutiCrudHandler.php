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
        try {
            $this->getConnection()->beginTransaction();
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
                'evidenza'         => $this->rawPost['evidenza'],
                'utente_id'        => $this->rawPost['user'],
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
            return $this->setErrorMessage($e->getMessage());
        }
    }

    protected function update()
    {
        try {
            $error = array();

            $varsToCheck = array('titolo', 'testo', 'dataInserimento', 'dataScadenza', 'attivo');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }

            $this->setArrayRecordToHandle('sottosezione_id', 'sottosezione');
            $this->setArrayRecordToHandle('titolo', 'titolo');
            $this->setArrayRecordToHandle('sommario', 'sommario');
            $this->setArrayRecordToHandle('testo', 'testo');
            $this->setArrayRecordToHandle('data_inserimento', 'dataInserimento');
            $this->setArrayRecordToHandle('data_scadenza', 'dataScadenza');
            $this->setArrayRecordToHandle('attivo', 'attivo');

            $this->getConnection()->beginTransaction();
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