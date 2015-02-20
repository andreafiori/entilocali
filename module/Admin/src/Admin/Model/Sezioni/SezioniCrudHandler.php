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
        $this->getConnection()->beginTransaction();
        try {
            // Validate
            $error = array();

            $varsToCheck = array('nome', 'colonna', 'posizione');
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
                'nome'                  => $this->rawPost['nome'],
                'colonna'               => $this->rawPost['colonna'],
                'posizione'             => $this->rawPost['posizione'],
                //'link_macro'          => $this->rawPost['link_macro'],
                'lingua'              => $this->rawPost['lingua'],
                'blocco'              => $this->rawPost['blocco'],
                'modulo_id'             => isset($this->rawPost['modulo']) ? $this->rawPost['modulo'] : 2,
                'attivo'                => $this->rawPost['attivo'],
                'url'                   => $this->rawPost['url'],
                //'css_id'              => $this->rawPost['css_id'],
                //'image'               => $this->rawPost['image'],
                //'slug'                => $this->rawPost['slug'],
                //'seo_title'           => $this->rawPost['seoTitle'],
                //'seo_description'     => $this->rawPost['seoDescription'],
                //'seo_keywords'        => $this->rawPost['seoKeywords'],
            ));
            $this->getConnection()->commit();

            // Log
            $userDetails  = $this->getInput('userDetails', 1);

            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => '2',
                'message'   => $userDetails->name.' '.$userDetails->surname."' ha aggiornato l'ente terzo ".$this->rawPost['nome'],
                'type'      => 'info',
                'backend'   => 1,
            ));

            if ($logResult!=1) {
                $this->setSuccessMessage('Dati salvati correttamente', 'Dati salvati correttamente, ma attenzione: il log non &egrave; stato scritto nel registro. Errore: '.$logResult, 'warning');
            } else {
                $this->setSuccessMessage();
            }

        } catch(\Exception $e) {
            $this->getConnection()->rollBack();
            // Log
            $errorMessage = $e->getMessage();
            $userDetails  = $this->getInput('userDetails', 1);

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
            $this->setArrayRecordToHandle('blocco', 'blocco');
            $this->setArrayRecordToHandle('modulo_id', 'modulo');
            $this->setArrayRecordToHandle('attivo', 'attivo');
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

            // Log
            $userDetails  = $this->getInput('userDetails', 1);

            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => '12',
                'message'   => $userDetails->name.' '.$userDetails->surname."' ha aggiornato la sezione ".$this->rawPost['nome'],
                'type'      => 'info',
                'backend'   => 1,
            ));

            if ($logResult!=1) {
                $this->setSuccessMessage('Dati salvati correttamente', 'Dati salvati correttamente, ma attenzione: il log non &egrave; stato scritto nel registro. Errore: '.$logResult, 'warning');
            } else {
                $this->setSuccessMessage();
            }

            $this->setSuccessMessage();

        } catch(\Exception $e) {
            $this->getConnection()->rollBack();

            // Log
            $errorMessage = $e->getMessage();
            $userDetails  = $this->getInput('userDetails', 1);

            $logsWriter = $this->getLogsWriter();
            $logResult = $logsWriter->writeLog(array(
                'user_id'   => $userDetails->id,
                'module_id' => '2',
                'message'   => $userDetails->name.' '.$userDetails->surname."', errore durante l'aggiornamento della sezione ".$this->rawPost['nome'].' Messaggio: '.$errorMessage,
                'type'      => 'error',
                'backend'   => 1,
            ));

            return $this->setErrorMessage($errorMessage);
        }
    }
}