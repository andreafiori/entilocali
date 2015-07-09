<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\NullException;

abstract class AttachmentPropertiesGetterChildAbstract
{
    protected $moduleCode;

    protected $attachmentsReferenceId;

    protected $attachmentsRelatedWrapper;

    protected $attachmentsRelatedRecords;

    protected $attachmentFormTitle;

    protected $breadcrumbModule;

    protected $breadcrumbRoute;

    protected $entityManager;

    /**
     * @return mixed
     */
    public function getModuleCode()
    {
        return $this->moduleCode;
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
    public function getAttachmentsRelatedWrapper()
    {
        return $this->attachmentsRelatedWrapper;
    }

    /**
     * @param mixed $attachmentsRelatedWrapper
     */
    public function setAttachmentsRelatedWrapper($attachmentsRelatedWrapper)
    {
        $this->attachmentsRelatedWrapper = $attachmentsRelatedWrapper;
    }

    /**
     * @return mixed
     */
    public function getAttachmentsRelatedRecords()
    {
        return $this->attachmentsRelatedRecords;
    }

    /**
     * @param mixed $attachmentsRelatedRecords
     */
    public function setAttachmentsRelatedRecords($attachmentsRelatedRecords)
    {
        $this->attachmentsRelatedRecords = $attachmentsRelatedRecords;
    }

    /**
     * @return string
     */
    public function getAttachmentFormTitle()
    {
        return $this->attachmentFormTitle;
    }

    /**
     * @param string $attachmentFormTitle
     */
    protected function setAttachmentFormTitle($attachmentFormTitle)
    {
        $this->attachmentFormTitle = $attachmentFormTitle;
    }

    /**
     * @return mixed
     */
    public function getBreadcrumbModule()
    {
        return $this->breadcrumbModule;
    }

    /**
     * @param mixed $breadcrumbModule
     */
    public function setBreadcrumbModule($breadcrumbModule)
    {
        $this->breadcrumbModule = $breadcrumbModule;
    }

    /**
     * @return mixed
     */
    public function getBreadcrumbRoute()
    {
        return $this->breadcrumbRoute;
    }

    /**
     * @param mixed $breadcrumbRoute
     */
    public function setBreadcrumbRoute($breadcrumbRoute)
    {
        $this->breadcrumbRoute = $breadcrumbRoute;
    }

    /**
     * @return mixed
     */
    public function getAttachmentsReferenceId()
    {
        return $this->attachmentsReferenceId;
    }

    /**
     * @param mixed $attachmentsReferenceId
     */
    public function setAttachmentsReferenceId($attachmentsReferenceId)
    {
        $this->attachmentsReferenceId = $attachmentsReferenceId;
    }

    /**
     * @return mixed
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param mixed $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function assertEntityManager()
    {
        if (!$this->getEntityManager()) {
            throw new NullException("Entity Manager is not set");
        }
    }
}