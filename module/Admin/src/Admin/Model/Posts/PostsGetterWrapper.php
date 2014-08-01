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
    private $postsGetter;
    
    private $category;
    private $title;
    private $template;

    /**
     * @param \Admin\Model\Posts\PostsGetter $postsGetter
     */
    public function __construct(PostsGetter $postsGetter)
    {
        $this->postsGetter = $postsGetter;
    }

    public function setupQueryBuilder()
    {
        $language   = $this->getInput('language', 1);
        $channel    = $this->getInput('channel', 1);
        
        $this->postsGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->postsGetter->setMainQuery();
        
        $this->postsGetter->setChannelId($channel ? $channel : 1);
        $this->postsGetter->setLanguageId($language ? $language : 1);
        $this->postsGetter->setId( $this->getInput('id', 1) );
        $this->postsGetter->setCategoryName( $this->getInput('category', 1) );
        $this->postsGetter->setTitle( $this->getInput('title', 1) );
        $this->postsGetter->setType( $this->getInput('type', 1) );
        $this->postsGetter->setStatus( $this->getInput('status', 1) );
        $this->postsGetter->setOrderBy( $this->getInput('orderBy', 1), 'po.position' );
        $this->postsGetter->setLimit( $this->getInput('limit', 1) );
    }
    
    /**
     * Setup query (for paginator)
     */
    public function setupQuery()
    {
        $entityManager = $this->getInput('entityManager', 1);

        $this->query = $entityManager->createQuery( $this->postsGetter->getDQLQuery() )
                                ->setFirstResult($this->firstResult)
                                ->setMaxResults($this->maxResults)
                                ->setParameters( $this->postsGetter->getQuery()->getParameters() )
                                ->getScalarResult();

        return $this->query;
    }
    
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
                $attachmentsGetterWrapper = new AttachmentsGetterWrapper( new AttachmentsGetter($this->getInput('entityManager',1)) );
                $attachmentsGetterWrapper->setInput( array() );
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
            $this->title = $row['title'];
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
            $postsRelationsGetter = new PostsRelationsGetter( $this->getInput('entityManager', 1) );
            $postsRelationsGetter->setSelectQueryFields('IDENTITY(r.category) AS category');
            $postsRelationsGetter->setMainQuery();
            $postsRelationsGetter->setChannelId(1);
            $postsRelationsGetter->setModuleId($row['module']);
            $postsRelationsGetter->setPostsId($row['postoptionid']);
            
            return $postsRelationsGetter->getQueryResult();
        }
    
    /**
     * @return array
     */
    public function getRecords()
    {
        return $this->postsGetter->getQueryResult();
    }
        
    /**
     * @return \Admin\Model\Posts\PostsGetter
     */
    public function getPostsGetter()
    {
        return $this->postsGetter;
    }
    
    /**     
     * @return string
     */
    public function getTemplate()
    {
        if (!$this->template) {
            $this->template = 'notfound.phtml';
        }
        return $this->template;
    }
    
    public function getCategory()
    {
        return $this->category;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
