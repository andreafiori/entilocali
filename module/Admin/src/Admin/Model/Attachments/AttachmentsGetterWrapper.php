<?php

namespace Admin\Model\Attachments;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\Attachments\AttachmentsGetter;

/**
 * @author Andrea Fiori
 * @since  25 July 2014
 */
class AttachmentsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var AttachmentsGetter
     */
    protected $objectGetter;
    
    /**
     * @param AttachmentsGetter $objectGetter
     */
    public function __construct(AttachmentsGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setReferenceId( $this->getInput('referenceId', 1) );
        $this->objectGetter->setAttachmentId( $this->getInput('attachmentId', 1) );
        $this->objectGetter->setModuleId( $this->getInput('moduleId', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
    }
}
