<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\Attachments\AttachmentPropertiesGetterChildAbstract;
use Admin\Model\Attachments\AttachmentPropertiesGetterChildInterface;

class AttiConcessioneAttachmentsPropertiesGetter extends AttachmentPropertiesGetterChildAbstract implements AttachmentPropertiesGetterChildInterface
{
    public function setupProperties()
    {
        $this->setupAttachmentRelatedRecords(array(
            'id' => $this->getAttachmentsReferenceId(),
        ));

        $relatedRecords = $this->getAttachmentsRelatedRecords();

        $this->setBreadcrumbModule('Atti concessione');
        $this->setBreadcrumbRoute('admin/atti-concessione-summary');
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
            $this->setAttachmentsRelatedWrapper(new AttiConcessioneGetterWrapper(
                    new AttiConcessioneGetter($this->getEntityManager()))
            );
        }
    }
}