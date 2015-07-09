<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\Modules\ModulesGetterWrapper;
use ModelModule\Model\NullException;

abstract class AttachmentsFormControllerHelperAbstract
{
    /**
     * @var ModulesGetterWrapper
     */
    protected $modulesGetterWrapper;

    protected $moduleRecords;

    protected $moduleCode;

    protected $classMap = array(
        'albo-pretorio'                 => '\ModelModule\Model\AlboPretorio\AlboPretorioAttachmentsPropertiesGetter',
        'stato-civile'                  => '\ModelModule\Model\StatoCivile\StatoCivileAttachmentsPropertiesGetter',
        'atti-concessione'              => '\ModelModule\Model\AttiConcessione\AttiConcessioneAttachmentsPropertiesGetter',
        'contratti-pubblici'            => '\ModelModule\Model\ContrattiPubblici\ContrattiPubbliciAttachmentsPropertiesGetter',
        'contenuti'                     => '\ModelModule\Model\Contenuti\ContenutiAttachmentsPropertiesGetter',
        'amministrazione-trasparente'   => '\ModelModule\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteAttachmentsPropertiesGetter',
        'blogs'                         => '\ModelModule\Model\Blogs\BlogsAttachmentsPropertiesGetter',
        'contents'                      => '\ModelModule\Model\Posts\ContentsAttachmentsPropertiesGetter',
    );

    /**
     * @var AttachmentsGetterWrapper
     */
    protected $attachmentsGetterWrapper;

    protected $attachmentRecords;

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
     * @return array|null
     */
    public function getModuleRecords()
    {
        return $this->moduleRecords;
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

    /**
     * @param AttachmentsGetterWrapper $wrapper
     */
    public function setAttachmentsGetterWrapper(AttachmentsGetterWrapper $wrapper)
    {
        $this->attachmentsGetterWrapper = $wrapper;
    }

    /**
     * @throws NullException
     */
    protected function assertAttachmentsGetterWrapper()
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

    /**
     * @param mixed $moduleCode
     */
    public function setModuleCode($moduleCode)
    {
        $this->moduleCode = $moduleCode;
    }

    /**
     * @return mixed
     */
    public function getModuleCode()
    {
        return $this->moduleCode;
    }

    /**
     * @throws NullException
     */
    protected function assertModuleCode()
    {
        if (!$this->getModuleCode()) {
            throw new NullException("ModuleCode is not set");
        }
    }
}
