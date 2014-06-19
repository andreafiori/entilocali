<?php

namespace Admin\Model\Posts;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * Posts Query and Records Getters
 * 
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsRelationsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('IDENTITY(r.posts) AS posts, IDENTITY(r.category) AS category, IDENTITY(r.module) AS module, IDENTITY(r.channel) AS canale');
        
        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsPostsRelations r ')
                                ->add('where', 'r.channel = :channel ');

        return $this->getQueryBuilder();
    }
 
    /**
     * @param number $channel
     */
    public function setChannelId($channel = null)
    {
        if (is_numeric($channel)) {
            $this->getQueryBuilder()->setParameter('channel', $channel);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $id
     * @return number
     */
    public function setPostsId($id = null)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('r.posts = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if ( is_array($id) ) {
            $this->getQueryBuilder()->andWhere('r.posts IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $id
     * @return number
     */
    public function setModuleId($id = null)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('r.module = :moduleId');
            $this->getQueryBuilder()->setParameter('moduleId', $id);
        }
        
        return $this->getQueryBuilder();
    }
}