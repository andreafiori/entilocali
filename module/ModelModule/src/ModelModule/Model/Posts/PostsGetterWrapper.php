<?php

namespace ModelModule\Model\Posts;

use ModelModule\Model\RecordsGetterWrapperAbstract;
use ModelModule\Model\Slugifier;

class PostsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var PostsGetter
     */
    protected $objectGetter;

    /**
     * @param PostsGetter $postsGetter
     */
    public function __construct(PostsGetter $postsGetter)
    {
        $this->setObjectGetter($postsGetter);
    }

    public function setupQueryBuilder()
    {
        $language   = $this->getInput('language', 1);
        $channel    = $this->getInput('channel', 1);
        
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setChannelId($channel ? $channel : 1);
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setCategoryId( $this->getInput('categoryId', 1) );
        $this->objectGetter->setCategorySlug( $this->getInput('categorySlug', 1) );
        $this->objectGetter->setSlug( $this->getInput('slug', 1) );
        $this->objectGetter->setTitle( $this->getInput('title', 1) );
        $this->objectGetter->setType( $this->getInput('type', 1) );
        $this->objectGetter->setStatus( $this->getInput('status', 1) );
        $this->objectGetter->setModuleCode( $this->getInput('moduleCode', 1) );
        $this->objectGetter->setNoScaduti( $this->getInput('noScaduti', 1) );
        $this->objectGetter->setLanguageId($language ? $language : 1);
        $this->objectGetter->setLanguageAbbreviation( $this->getInput('languageAbbr', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }

    /**
     * Add category slug to an array recordset
     *
     * @param array $recordset
     * @return array|null
     */
    public function addCategorySlugToRecordset($recordset)
    {
        foreach($recordset as &$record) {
            $record['categorySlug'] = Slugifier::slugify($record['categoryName']);
        }

        return $recordset;
    }
}
