<?php

namespace Admin\Model\Attachments;

use Admin\Model\Modules\ModulesGetterWrapper;
use Application\Model\NullException;

class AttachmentsFormControllerHelper
{
    /**
     * @var ModulesGetterWrapper
     */
    private $modulesGetterWrapper;

    private $moduleRecords;

    /**
     * @var AttachmentsGetterWrapper
     */
    private $attachmentsGetterWrapper;

    private $attachmentRecords;

    /**
     * @param ModulesGetterWrapper $wrapper
     */
    public function setModulesGetterWrapper(ModulesGetterWrapper $wrapper)
    {
        $this->modulesGetterWrapper = $wrapper;
    }

    /**
     * @return ModulesGetterWrapper
     */
    public function getModulesGetterWrapper()
    {
        return $this->modulesGetterWrapper;
    }

    /**
     * @param $moduleSlug
     * @throws NullException
     */
    public function setupModuleRecords($moduleSlug)
    {
        $this->assertModulesGetterWrapper();

        $this->getModulesGetterWrapper()->setInput( array('code' => $moduleSlug, 'limit' => 1) );
        $this->getModulesGetterWrapper()->setupQueryBuilder();

        $this->moduleRecords = $this->getModulesGetterWrapper()->getRecords();
    }

    /**
     * @return array|null
     */
    public function getModuleRecords()
    {
        return $this->moduleRecords;
    }

    /**
     * @return int|null
     */
    public function recoverModuleId()
    {
        return isset($this->moduleRecords[0]['id']) ? $this->moduleRecords[0]['id'] : null;
    }

    /**
     * @throws NullException
     */
    protected function assertModulesGetterWrapper()
    {
        if (!$this->modulesGetterWrapper) {
            throw new NullException("Il presente modulo non &egrave; stato trovato. Se l'errore persiste, contattare l'amministrazione");
        }
    }

    public function checkModuleRecords()
    {
        $moduleRecords = $this->getModuleRecords();

        if ( !isset($moduleRecords[0]['id']) ) {
            throw new NullException("Il presente modulo non &egrave; stato trovato. Se l'errore persiste, contattare l'amministrazione");
        }
    }

    /**
     * @param AttachmentsGetterWrapper $wrapper
     */
    public function setAttachmentsGetterWrapper(AttachmentsGetterWrapper $wrapper)
    {
        $this->attachmentsGetterWrapper = $wrapper;
    }

    /**
     * @param array $input
     * @return array
     */
    public function setupAttachmentsRecords($input = array())
    {
        $this->assertAttachmentsGetterWrapper();

        $this->getAttachmentsGetterWrapper()->setInput($input);
        $this->getAttachmentsGetterWrapper()->setupQueryBuilder();

        $this->attachmentRecords = $this->getAttachmentsGetterWrapper()->getRecords();
    }

    private function assertAttachmentsGetterWrapper()
    {
        if (!$this->getAttachmentsGetterWrapper()) {
            throw new NullException("AttachmentsGetterWrapper is not set");
        }
    }

    /**
     * @return AttachmentsGetterWrapper
     */
    public function getAttachmentsGetterWrapper()
    {
        return $this->attachmentsGetterWrapper;
    }

    /**
     * @return mixed
     */
    public function getAttachmentRecords()
    {
        return $this->attachmentRecords;
    }
}
