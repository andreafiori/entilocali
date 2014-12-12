<?php

namespace Admin\Model\Attachments;

use Admin\Model\FormData\CrudHandlerAbstract;
use Admin\Model\FormData\CrudHandlerInterface;

class AttachmentsCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $tableName = 'zfcms_attachments';
    
    /**
     * Check module id and ID record to associate
     * Check storage method
     * Insert into db zfcms_attachments
     * Select mimetype, take Id
     * Insert into db zfcms_attachments_options
     * Insert into db zfcms_attachments_relations
     * Insert into Amazon S3 bucket -> module-dir
     * 
     */
    protected function insert()
    {
        /*
        $this->getConnection()->beginTransaction();
        try {
            $this->getConnection()->insert($this->tableName, array(
                'utente_id'             => $this->rawPost['utente'],
                
            ));

            $this->getConnection()->commit();

            $this->setVariable('messageType',   'success');
            $this->setVariable('messageTitle',  'Dati inseriti correttamente');
            $this->setVariable('messageText',   'Dati inseriti correttamente in archivio.');
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
        */
    }
    
    protected function update()
    {
        
    }
    
    protected function delete()
    {
        
    }
}



