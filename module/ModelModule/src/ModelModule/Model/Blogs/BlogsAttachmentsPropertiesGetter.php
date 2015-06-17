<?php

namespace ModelModule\Model\Blogs;

use ModelModule\Model\Attachments\AttachmentPropertiesGetterChildAbstract;
use ModelModule\Model\Attachments\AttachmentPropertiesGetterChildInterface;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;

class BlogsAttachmentsPropertiesGetter extends AttachmentPropertiesGetterChildAbstract implements AttachmentPropertiesGetterChildInterface
{
    public function setupProperties()
    {
        $this->setupAttachmentRelatedRecords(array(
            'id' => $this->getAttachmentsReferenceId(),
        ));

        $relatedRecords = $this->getAttachmentsRelatedRecords();

        $this->setBreadcrumbModule('Blogs');
        $this->setBreadcrumbRoute('admin/blogs-summary');
        $this->setAttachmentFormTitle(!empty($relatedRecords[0]['title']) ? $relatedRecords[0]['title'] : null);
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
            $this->setAttachmentsRelatedWrapper(new PostsGetterWrapper(new PostsGetter($this->getEntityManager())) );
        }
    }
}