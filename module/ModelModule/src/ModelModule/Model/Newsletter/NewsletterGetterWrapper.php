<?php

namespace ModelModule\Model\Newsletter;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class NewsletterGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var NewsletterGetter
     */
    protected $objectGetter;

    /**
     * @param NewsletterGetter $objectGetter
     */
    public function __construct(NewsletterGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }

    /**
     * @return null
     */
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setSent( $this->getInput('sent', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}