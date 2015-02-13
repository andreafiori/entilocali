<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  16 December 2014
 */
class AttiConcessioneCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_concessione';

    public function insert()
    {
        try {

            $error = array();

            $varsToCheck = array('titolo', 'beneficiario', 'importo', 'modassegn', 'data', 'sezione', 'anno');
            foreach($varsToCheck as $var) {
                if ( !isset($this->rawPost[$var]) or empty($this->rawPost[$var]) ) {
                    $error[] = 'Campo <strong>'.$var.'</strong> non settato fra i campi del form';
                }
            }

            if (!is_numeric($this->rawPost['importo'])) {
                $error[] = '<strong>Importo</strong> deve essere un valore numerico.';
            }

            if ( (int)$this->rawPost['anno'] > 2030 or (int)$this->rawPost['anno'] < 1954 ) {
                $error[] = '<strong>Anno atto</strong> deve essere un anno valido di valore numerico.';
            }
            
            if (!empty($error)) {
                $this->setErrorMessage($error);
                return;
            } else {
                $this->getConnection()->beginTransaction();
                $this->getConnection()->insert($this->tableName, array(
                    'titolo'        => $this->rawPost['titolo'],
                    'beneficiario'  => $this->rawPost['beneficiario'],
                    'importo'       => $this->rawPost['importo'],
                    'modassegn'     => $this->rawPost['modassegn'],
                    'data'          => $this->rawPost['data'],
                    'ora'           => date("H:i:s"),
                    'resp_proc_id'  => $this->rawPost['respProc'],
                    'settore_id'    => $this->rawPost['settore'],
                    'utente_id'    => $this->rawPost['utente_id'],
                ));

                $this->getConnection()->commit();

                $this->setVariable('redirectRoute', 1);
                $this->setVariable('redirectRouteTableSetter', 'atti-concessione');
                
                $this->setSuccessMessage('Atto inserito correttamente');
            }

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    public function update()
    {
        try {
            $this->cleanArrayRecordToHandle();
            $this->setArrayRecordToHandle('titolo', 'titolo');
            $this->setArrayRecordToHandle('beneficiario', 'beneficiario');
            $this->setArrayRecordToHandle('importo', 'importo');
            $this->setArrayRecordToHandle('modassegn', 'modassegn');
            $this->setArrayRecordToHandle('data', 'data');
            $this->setArrayRecordToHandle('anno', 'anno');

            $affectedRows = $this->getConnection()->update(
                $this->tableName,
                $this->getArrayRecordToHandle(),
                array('id' => $this->rawPost['id'])
            );

            /* Show success message */
            $this->setSuccessMessage('Dati aggiornati correttamente', 'Dati aggiornati correttamente in archivio.');

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
    
    public function delete()
    {
        
    }
}
