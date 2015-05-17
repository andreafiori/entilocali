<?php

namespace Admin\Model\Posts;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsRelationsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('IDENTITY(r.posts) AS postsId,
                                    IDENTITY(r.category) AS categoryId,
                                    IDENTITY(r.module) AS moduleId,
                                    IDENTITY(r.channel) AS channelId
                                    ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsPostsRelations', 'r')
                                ->join('r.module', 'module')
                                ->join('r.posts', 'posts')
                                ->join('r.category', 'categ')
                                ->where('r.channel = :channel AND r.module = module.id
                                        AND r.posts = posts.id AND r.category = categ.id
                                        ');

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