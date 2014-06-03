<?php

namespace Application\Model\Posts;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * Posts Query and Records Getters
 * 
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsRelazioniGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('IDENTITY(r.posts) AS posts, IDENTITY(r.categoria) AS categoria, IDENTITY(r.modulo) AS modulo, IDENTITY(r.canale) AS canale');
        
        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\PostsRelazioni r ')
                                ->add('where', 'r.canale = :channel ');

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
    public function setModuloId($id = null)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('r.modulo = :moduloId');
            $this->getQueryBuilder()->setParameter('moduloId', $id);
        }
        
        return $this->getQueryBuilder();
    }
}