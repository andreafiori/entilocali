<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  29 July 2014
 */
class AlboPretorioSezioniCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_comuni_albo_sezioni';
    
    protected function insert()
    {
        $this->getConnection()->beginTransaction();
        try {
            
            $this->getConnection()->insert($this->tableName, array(
                'nome' => $this->rawPost['nome'],
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
            
            $this->getConnection()->update($this->tableName, array(
                'nome'  => $this->rawPost['nome'],
            ),  array('id' => $this->rawPost['id']) );

            $this->getConnection()->commit();

            $this->setSuccessMessage();
            
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
}
