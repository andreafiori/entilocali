<?php

namespace Admin\Model\Posts;

use Application\Model\QueryBuilderHelperAbstract;
use Application\Model\Slugifier;

/**
 * Posts Query and Records Getters
 * 
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(p.id) AS postid, po.id AS postoptionid, p.lastUpdate, p.insertDate, p.expireDate, p.type, p.alias, po.title, po.status, po.description, po.seoUrl, po.subtitle, po.seoDescription, po.seoKeywords, p.templateFile, p.flagAttachments, co.name AS categoryName, c.template, IDENTITY(r.module) AS modulo');

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
        if (is_numeric($channel)) {
            $this->getQueryBuilder()->setParameter('channel', $channel);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $languageId
     */
    public function setLanguageId($languageId = null)
    {
        if (is_numeric($languageId)) {
            $this->getQueryBuilder()->setParameter('language', $languageId);
        }
    }
    
    /**
     * @param number or array $id
     * @return type
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
     */
    public function setTitle($title)
    {
        if ( is_string($title) ) {
            $this->getQueryBuilder()->andWhere('po.title = :title');
            $this->getQueryBuilder()->setParameter('title', Slugifier::deSlugify($title) );
        }
        
        return $this->getQueryBuilder();
    }
  
    /**
     * @param string $type post type (content, blog, photo or video)
     */
    public function setType($type)
    {
        if ( is_string($type) ) {
            $this->getQueryBuilder()->andWhere('p.type = :postType');
            $this->getQueryBuilder()->setParameter('postType', Slugifier::deSlugify($type) );
        }
        
        return $this->getQueryBuilder();
    }
       
    /**
     * @param string or null $status
     */
    public function setStatus($status = null)
    {
        if ($status == 'NULL' or $status == 'null') {
            $this->getQueryBuilder()->andWhere('po.status IS NULL ');
        } elseif ($status != null) {
            $this->getQueryBuilder()->andWhere("po.status = '$status' ");
        }
    }
    
    /**
     * @param string $orderBy
     */
    public function setOrderBy($orderBy = null)
    {
        if (!$orderBy) {
            $orderBy = 'po.position';
        }
        
        $this->getQueryBuilder()->add('orderBy', $orderBy);
        
        return $this->getQueryBuilder();
    }
    
    /**
     * Return posts records with link to details and attachments
     * 
     * @return string
     */
    public function getQueryResult()
    {    
        $posts = parent::getQueryResult();
        if ( !is_array($posts) ) {
            return false;
        }
        
        $postsRelazioni = new PostsRelationsGetter($this->getEntityManager());
        
        for($i = 0; $i < count($posts); $i++) {
            
            if ( !isset($posts[$i]) ) {
                break;
            }
            
            $posts[$i] = array_filter($posts[$i]);

            $posts[$i]['linkDetails'] = '/'.Slugifier::slugify($posts[$i]['nomeCategoria']).'/'.Slugifier::slugify($posts[$i]['titolo']);
            
            // TODO: attachments...  
            if ( $posts[$i]['flagAllegati'] == 'si' ) {

            }
            
            // TODO: Categories ids from post_relazioni
            //$language   = $this->getInput('language', 1);
            //$channel    = $this->getInput('channel', 1);
            
            
            $postsRelazioni->setSelectQueryFields('IDENTITY(r.category) AS category');
            $postsRelazioni->setMainQuery();
            $postsRelazioni->setChannelId(isset($channel) ? $channel : 1);
            $postsRelazioni->setModuloId($posts[$i]['module']);
            $postsRelazioni->setPostsId($posts[$i]['postoptionid']);
            $categories = $postsRelazioni->getQueryResult();
            foreach ($categories as $categoria) {
                $posts[$i]['categories'][] = $categoria['category'];
            }
            
            if ( isset($posts[$i]['template']) ) {
                continue;
            }

            if ( count($posts) === 1 ) {
                if (!isset($posts[$i]['template'])) {
                    $posts[$i]['template'] = $posts[$i]['type'].'/details.phtml';
                }
            } elseif ( count($posts) > 1 ) {
                if (!isset($posts[$i]['template'])) {
                    $posts[$i]['template'] = $posts[$i]['type'].'/list.phtml';
                }
            }

        }
        
        return $posts;
    }
    
}
