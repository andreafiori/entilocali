<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
class AttachmentsMimetypeGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var AttachmentsMimetypeGetter
     */
    protected $objectGetter;
    
    /**
     * @param AttachmentsMimetypeGetter $objectGetter
     */
    public function __construct(AttachmentsMimetypeGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setMimeType( $this->getInput('mimetype', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
    }
}
