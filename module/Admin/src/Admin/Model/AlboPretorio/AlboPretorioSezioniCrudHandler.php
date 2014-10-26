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
    protected function insert()
    {
        $this->getConnection()->beginTransaction();
        try {
            $this->getConnection()->insert('zfcms_comuni_albo_sezioni', array(
                'nome'  => $this->rawPost['nome'],
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
            $this->getConnection()->update('zfcms_comuni_albo_sezioni', array(
                'nome'  => $this->rawPost['nome'],
            ),  array('id' => $this->rawPost['id']) );

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
}
