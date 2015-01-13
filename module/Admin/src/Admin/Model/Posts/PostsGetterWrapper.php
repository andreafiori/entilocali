<?php

namespace Admin\Model\Posts;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;
use Application\Model\NullException;
use Application\Model\Slugifier;
use stdClass;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var PostsGetter
     */
    protected $objectGetter;
    
    private $category;
    private $title;
    private $template;

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
        $this->objectGetter->setLanguageId($language ? $language : 1);
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setCategoryName( $this->getInput('category', 1) );
        $this->objectGetter->setTitle( $this->getInput('title', 1) );
        $this->objectGetter->setType( $this->getInput('type', 1) );
        $this->objectGetter->setStatus( $this->getInput('status', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1), 'po.position' );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }

    /**
     * Add array additional records to the paginator recordset
     * 
     * @return \stdClass
     * @throws NullException
     */
    public function setupRecords()
    {
        if (!$this->paginator) {
            throw new NullException("Setup paginator before setting additional records");
        }
        
        $paginatorCount = 0;
        foreach($this->paginator as $key => $row) {
            $paginatorCount++;
        }
        
        $paginatorToReturn = new stdClass();
        foreach($this->paginator as $key => $row) {
            $row['linkDetails'] = '/'.Slugifier::slugify($row['categoryName']).'/'.Slugifier::slugify($row['seoTitle']);
            $row['linkCategory'] = '/'.Slugifier::slugify($row['categoryName']);
            
            if ( $row['flagAttachments'] == 'si' ) {
                $attachmentsGetterWrapper = new AttachmentsGetterWrapper( new AttachmentsGetter($this->getObjectGetter()->getEntityManager()) );
                $attachmentsGetterWrapper->setInput( array('referenceId'=>$row['id']) );
                $attachmentsGetterWrapper->setupQueryBuilder();
                
                $row['attachments'] = $attachmentsGetterWrapper->getRecords();
            }
            
            $categories = $this->getCategoriesFromPostsRelations($row);
            foreach ($categories as $category) {
                $row['categories'][] = $category['category'];
            }
            
            if ( isset($row['template']) ) {
                continue;
            }
            
            if ($paginatorCount == 1) {
                $row['template'] = $row['type'].'/details.phtml';
            } elseif ($paginatorCount > 1) {
                $row['template'] = $row['type'].'/list.phtml';
            }

            $this->template = $row['template'];
            $this->title    = $row['title'];
            $this->category = $row['categoryName'];
            
            $paginatorToReturn->$key = $row;
        }
        
        return $paginatorToReturn;
    }
    
        /**
         * @param array $row
         * @return array
         */
        private function getCategoriesFromPostsRelations(array $row)
        {
            $postsRelationsGetter = new PostsRelationsGetter( $this->getObjectGetter()->getEntityManager() );
            $postsRelationsGetter->setSelectQueryFields('IDENTITY(r.category) AS category');
            $postsRelationsGetter->setMainQuery();
            $postsRelationsGetter->setChannelId(1);
            $postsRelationsGetter->setModuleId($row['module']);
            $postsRelationsGetter->setPostsId($row['postoptionid']);
            
            return $postsRelationsGetter->getQueryResult();
        }
    
    /**     
     * @return string|null
     */
    public function getTemplate()
    {
        if (!$this->template) {
            $this->template = 'notfound.phtml';
        }
        
        return $this->template;
    }
    
    /**
     * @return string|null
     */    
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }
}
