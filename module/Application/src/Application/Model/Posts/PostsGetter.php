<?php

namespace Application\Model\Posts;

use Application\Model\QueryBuilderHelperAbstract;
use Application\Model\Slugifier;

/**
 * Posts Query and Records Getter
 * 
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->getQueryBuilder()->add('select', "DISTINCT(p.id) AS postid, po.id AS postoptionid, p.tipo, p.alias, po.titolo, p.stato, po.descrizione, po.seoUrl, po.sottotitolo, po.seoDescription, po.seoKeywords, p.templateFile, p.flagAllegati, co.nome AS nomeCategoria, c.template")
                                ->add('from', 'Application\Entity\Posts p, Application\Entity\PostsOpzioni po, Application\Entity\PostsRelazioni r, Application\Entity\Categorie c, Application\Entity\CategorieOpzioni co')
                                //->addSelect(" ( SELECT COUNT(posts.id) FROM Application\Entity\Posts posts, Application\Entity\PostsRelations pr, Application\Entity\Attachments a WHERE ( posts.id = pr.attachment_id and posts_id.id = pr.posts and a.id = pr.posts ) AND posts.typeofpost = 'attachment' ) AS totattachments ")
                                ->add('where', 'po.posts = p.id AND p.id = r.posts AND c.id = r.categoria AND co.categoria = c.id AND r.canale = :channel AND co.lingua = :language AND po.lingua = :language');
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('p.id = :id AND po.id = :id');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
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
     * Return posts records with link to details and attachments
     * 
     * @return string
     */
    public function getQueryResult()
    {
        $posts = parent::getQueryResult();
        if (is_array($posts) ) {
            
            for($i = 0; $i < count($posts); $i++) {
                
                if ( !isset($posts[$i]) ) {
                    break;
                }
                
                // get post link to detail
                $posts[$i]['linkDetails'] = '/'.Slugifier::slugify($posts[$i]['nomeCategoria']).'/'.Slugifier::slugify($posts[$i]['titolo']);
                                
                // get template view path
                if ( isset($posts[$i]['template']) ) {
                    continue;
                }
                if ( count($posts) === 1 ) {
                    $posts[$i]['template'] = $posts[$i]['tipo'].'/details.phtml';
                } elseif ( count($posts) > 1 ) {
                    $posts[$i]['template'] = $posts[$i]['tipo'].'/list.phtml';
                }

                if ( $posts[$i]['flagAllegati'] == 'si' ) {
                    // TODO: get attachment record files
                }

            }
            return $posts;
        }
        return false;
    }
    
}
