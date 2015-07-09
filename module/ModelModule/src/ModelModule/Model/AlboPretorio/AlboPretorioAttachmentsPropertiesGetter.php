<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\Attachments\AttachmentPropertiesGetterChildAbstract;
use ModelModule\Model\Attachments\AttachmentPropertiesGetterChildInterface;

class AlboPretorioAttachmentsPropertiesGetter extends AttachmentPropertiesGetterChildAbstract implements AttachmentPropertiesGetterChildInterface
{
    public function setupProperties()
    {
        $this->setupAttachmentRelatedRecords(array(
            'id'        => $this->getAttachmentsReferenceId(),
            'fields'    => 'alboArticoli.id, alboArticoli.titolo'
        ));

        $relatedRecords = $this->getAttachmentsRelatedRecords();

        $this->setBreadcrumbModule('Albo pretorio');
        $this->setBreadcrumbRoute('admin/albo-pretorio-summary');
        $this->setAttachmentFormTitle(!empty($relatedRecords[0]['titolo']) ? $relatedRecords[0]['titolo'] : null);
    }

    /**
     * @param array $input
     */
    private function setupAttachmentRelatedRecords($input = array())
    {
        $this->assertEntityManager();

        $this->assertAttachmentRelatedWrapper();

        $this->getAttachmentsRelatedWrapper()->setInput($input);
        $this->getAttachmentsRelatedWrapper()->setupQueryBuilder();

        $this->setAttachmentsRelatedRecords( $this->getAttachmentsRelatedWrapper()->getRecords() );
    }

    private function assertAttachmentRelatedWrapper()
    {
        if (!$this->getAttachmentsRelatedWrapper()) {
            $this->setAttachmentsRelatedWrapper(new AlboPretorioArticoliGetterWrapper(
                    new AlboPretorioArticoliGetter($this->getEntityManager()))
            );
        }
    }
}