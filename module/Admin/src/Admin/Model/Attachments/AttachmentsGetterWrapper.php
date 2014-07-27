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
     * @param \Admin\Model\Attachments\AttachmentsGetter $attachmentsGetter
     */
    public function __construct(AttachmentsGetter $attachmentsGetter)
    {
        $this->setObjectGetter($attachmentsGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setModuleId( $this->getInput('id', 1) );
    }
}
