<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Admin\Model\Attachments\AttachmentPropertiesGetterChildAbstract;
use Admin\Model\Attachments\AttachmentPropertiesGetterChildInterface;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;

class AmministrazioneTrasparenteAttachmentsPropertiesGetter extends AttachmentPropertiesGetterChildAbstract implements AttachmentPropertiesGetterChildInterface
{
    public function setupProperties()
    {
        $this->setupAttachmentRelatedRecords(array(
            'id' => $this->getAttachmentsReferenceId(),
        ));

        $relatedRecords = $this->getAttachmentsRelatedRecords();

        $this->setBreadcrumbModule('Amministrazione trasparente');
        $this->setBreadcrumbRoute('admin/contenuti-summary');
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
            $this->setAttachmentsRelatedWrapper(new ContenutiGetterWrapper(
                    new ContenutiGetter($this->getEntityManager()))
            );
        }
    }
}