<?php

namespace Admin\Model\Posts;

use Application\Model\QueryBuilderHelperAbstract;
use Application\Model\Slugifier;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(p.id) AS postid, po.id AS postoptionid, p.lastUpdate, p.insertDate, p.expireDate, p.type, p.alias, po.title, po.subtitle, po.status, po.description, po.seoUrl, po.seoTitle, po.seoDescription, po.seoKeywords, p.flagAttachments, co.name AS categoryName, c.template, IDENTITY(r.module) AS module');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsPosts p, Application\Entity\ZfcmsPostsOptions po, Application\Entity\ZfcmsPostsRelations r, Application\Entity\ZfcmsCategories c, Application\Entity\ZfcmsCategoriesOptions co')
                                ->add('where', 'po.posts = p.id AND p.id = r.posts AND c.id = r.category AND co.category = c.id AND r.channel = :channel AND co.language = :language AND po.language = :language');
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number $channel
     */
    public function setChannelId($channel = null)
    {
        if ( is_numeric($channel) ) {
            $this->getQueryBuilder()->setParameter('channel', $channel);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $languageId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLanguageId($languageId = null)
    {
        if (is_numeric($languageId)) {
            $this->getQueryBuilder()->setParameter('language', $languageId);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('p.id = :id AND po.id = :id');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('p.id IN ( :id ) AND po.id IN ( :id )');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param string $category
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setCategoryName($category)
    {
        if ( is_string($category) ) {
            $this->getQueryBuilder()->andWhere('co.name = LOWER( :categoryName ) ');
            $this->getQueryBuilder()->setParameter('categoryName', Slugifier::deSlugify($category) );
        }
        return $this->getQueryBuilder();
    }

    /**
     * @param string $title post title
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setTitle($title)
    {
        if ( is_string($title) ) {
            $this->getQueryBuilder()->andWhere('LOWER( po.seoTitle ) =  :title ');
            $this->getQueryBuilder()->setParameter('title', Slugifier::deSlugify($title) );
        }
        return $this->getQueryBuilder();
    }
  
    /**
     * @param string|array $type post type (content, blog, photo or video)
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setType($type)
    {
        if ( is_string($type) ) {
            $this->getQueryBuilder()->andWhere('p.type = :postType');
            $this->getQueryBuilder()->setParameter('postType', Slugifier::deSlugify($type) );
        } elseif ( is_array($type) ) {
            $this->getQueryBuilder()->andWhere( $this->getQueryBuilder()->expr()->in('p.type', $type));
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param string or null $status
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setStatus($status = null)
    {
        if ($status == 'NULL' or $status == 'null') {
            $this->getQueryBuilder()->andWhere('po.status IS NULL ');
        } elseif ($status != null) {
            $this->getQueryBuilder()->andWhere("po.status = :status ");
            $this->getQueryBuilder()->setParameter('status', $status);
        }
        
        return $this->getQueryBuilder();
    }
}
