<?php

namespace Application\Model\Posts;

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
        $this->setSelectQueryFields('DISTINCT(p.id) AS postid, po.id AS postoptionid, p.tipo, p.alias, po.titolo, p.stato, po.descrizione, po.seoUrl, po.sottotitolo, po.seoDescription, po.seoKeywords, p.templateFile, p.flagAllegati, co.nome AS nomeCategoria, c.template');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\Posts p, Application\Entity\PostsOpzioni po, Application\Entity\PostsRelazioni r, Application\Entity\Categorie c, Application\Entity\CategorieOpzioni co')
                                ->add('where', 'po.posts = p.id AND p.id = r.posts AND c.id = r.categoria AND co.categoria = c.id AND r.canale = :channel AND co.lingua = :language AND po.lingua = :language'); 

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
     * 
     * @param number $id
     * @return type
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('p.id = :id AND po.id = :id');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param string $category
     */
    public function setNomeCategoria($category)
    {
        if ( is_string($category) ) {
            $this->getQueryBuilder()->andWhere('co.nome = LOWER( :nome_categoria ) ');
            $this->getQueryBuilder()->setParameter('nome_categoria', Slugifier::deSlugify($category) );
        }
    }

    /**
     * @param string $titolo post titolo
     */
    public function setTitolo($titolo)
    {
        if ( is_string($titolo) ) {
            $this->getQueryBuilder()->andWhere('po.titolo = :titolo');
            $this->getQueryBuilder()->setParameter('titolo', Slugifier::deSlugify($titolo) );
        }
    }
  
    /**
     * @param string $tipo post tipo (content, blog, photo or video)
     */
    public function setTipo($tipo)
    {
        if ( is_string($tipo) ) {
            $this->getQueryBuilder()->andWhere('p.tipo = :tipopost');
            $this->getQueryBuilder()->setParameter('tipopost', Slugifier::deSlugify($tipo) );
        }
    }
    
    /**
     * @param string $orderBy
     */
    public function setOrderBy($orderBy = null)
    {
        if (!$orderBy) {
            $orderBy = 'po.posizione';
        }
        
        $this->getQueryBuilder()->add('orderBy', $orderBy);
    }
    
    public function setStato($status = null)
    {
        if ( !$status ) {
            $this->getQueryBuilder()->andWhere('p.stato IS NULL ');
        } else {
            $this->getQueryBuilder()->andWhere("p.stato = '$status' ");
        }        
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
        
        for($i = 0; $i < count($posts); $i++) {
            
            if ( !isset($posts[$i]) ) {
                break;
            }
            
            $posts[$i] = array_filter($posts[$i]);

            $posts[$i]['linkDetails'] = '/'.Slugifier::slugify($posts[$i]['nomeCategoria']).'/'.Slugifier::slugify($posts[$i]['titolo']);
            
            if ( $posts[$i]['flagAllegati'] == 'si' ) {

            }
            
            if ( isset($posts[$i]['template']) ) {
                continue;
            }

            if ( count($posts) === 1 ) {
                if (!isset($posts[$i]['template'])) {
                    $posts[$i]['template'] = $posts[$i]['tipo'].'/details.phtml';
                }
            } elseif ( count($posts) > 1 ) {
                if (!isset($posts[$i]['template'])) {
                    $posts[$i]['template'] = $posts[$i]['tipo'].'/list.phtml';
                }
            }

        }
        return $posts;
    }
    
}
