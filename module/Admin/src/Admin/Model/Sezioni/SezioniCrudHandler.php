<?php

namespace Admin\Model\Sezioni;

use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  17 February 2014
 */
class SezioniCrudHandler extends CrudHandlerAbstract
{
    private $tableName = 'zfcms_comuni_sezioni';

    public function insert()
    {

    }

    public function update()
    {
        $this->setArrayRecordToHandle('name', 'name');

        $this->getConnection()->beginTransaction();
        try {

            $varsToCheck = array('titolo', 'testo');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }

            $this->setArrayRecordToHandle('nome', 'nome');
            $this->setArrayRecordToHandle('colonna', 'colonna');
            $this->setArrayRecordToHandle('posizione', 'posizione');
            $this->setArrayRecordToHandle('link_macro', 'link_macro');
            $this->setArrayRecordToHandle('lingua', 'lingua');
            $this->setArrayRecordToHandle('modulo_id', 'modulo');
            $this->setArrayRecordToHandle('url', 'url');
            $this->setArrayRecordToHandle('css_id', 'cssId');
            $this->setArrayRecordToHandle('image', 'image');
            $this->setArrayRecordToHandle('slug', 'slug');
            $this->setArrayRecordToHandle('seo_title', 'seoTitle');
            $this->setArrayRecordToHandle('seo_description', 'seoDescription');
            $this->setArrayRecordToHandle('seo_keywords', 'seoKeywords');

            $this->getConnection()->update(
                $this->tableName, $this->getArrayRecordToHandle(), array(
                    'id' => $this->rawPost['id']
                )
            );

            $this->getConnection()->commit();

            $this->setSuccessMessage();

        } catch(\Exception $e) {
            $this->getConnection()->rollBack();

            return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
        }
    }
}