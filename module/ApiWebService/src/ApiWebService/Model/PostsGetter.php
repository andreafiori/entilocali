<?php

namespace ApiWebService\Model;

use Application\Model\DoctrineDbManagerAbstract;
use Application\Model\Slugifier;

/**
 * Posts Query and Records Getter
 * 
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetter extends DoctrineDbManagerAbstract
{
    public function setMainQuery()
    {
        $this->getQueryBuilder()->add('select', "DISTINCT(p.id) AS postid, po.id AS postoptionid, p.tipo, p.alias, po.titolo, p.stato, po.descrizione, po.seoUrl, po.seoDescription, po.seoKeywords, p.templateFile, p.tipo, co.nome AS nomeCategoria, c.template")
                            ->add('from', 'Application\Entity\Posts p, Application\Entity\PostsOpzioni po, Application\Entity\PostsRelazioni r, Application\Entity\Categorie c, Application\Entity\CategorieOpzioni co')
                            ->add('where', 'po.posts = p.id AND p.id = r.posts AND c.id = r.categoria AND co.categoria = c.id AND r.categoria = c.id AND r.canale = :channel AND co.lingua = :language AND po.lingua = :language');
                            //->addSelect(" ( SELECT COUNT(posts.id) FROM Application\Entity\Posts posts, Application\Entity\PostsRelations pr, Application\Entity\Attachments a WHERE ( posts.id = pr.attachment_id and posts_id.id = pr.posts and a.id = pr.posts ) AND posts.typeofpost = 'attachment' ) AS totattachments ")
    }
    
    /**
     * @param number $id
     */
    public function setId($id)
    {
        if ( \is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('p.id = :id AND po.id = :id');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
    }
    
    /**
     * @param string $category
     */
    public function setNomeCategoria($category)
    {
        if ($category) {
            $this->getQueryBuilder()->andWhere('co.nome = :nome_categoria ');
            $this->getQueryBuilder()->setParameter('nome_categoria', Slugifier::deSlugify($category));
        }
    }

    /**
     * @param string $titolo post titolo
     */
    public function setTitolo($titolo)
    {
         if ($titolo) {
            $this->getQueryBuilder()->andWhere('po.titolo = :titolo');
            $this->getQueryBuilder()->setParameter('titolo', Slugifier::deSlugify($titolo) );
        }
    }
  
    /**
     * @param string $tipo post tipo (content, blog, photo or video)
     */
    public function setTipo($tipo)
    {
        if ($tipo) {
            $this->getQueryBuilder()->andWhere('p.tipo = :tipopost');
            $this->getQueryBuilder()->setParameter('tipopost', Slugifier::deSlugify($tipo) );
        }
    }
    
    /**
     * Return posts records with link to details and attachments (TODO)
     * 
     * @return string
     */
    public function getQueryResult()
    {
        $posts = parent::getQueryResult();
        if ($posts) {
            for($i = 0; $i < \count($posts); $i++) {
                $posts[$i] = array_filter($posts[$i]);
                $posts[$i]['linkDetails'] = '/'.Slugifier::slugify($posts[$i]['nomeCategoria']).'/'.Slugifier::slugify($posts[$i]['titolo']);
                // TODO: if ( attachmentCount > 1 ) get attachment data from db using another class
            }

            if ( \count($posts) === 1 ) {
                $template = $posts[0]['tipo'].'/details.phtml';
            } elseif ( \count($posts) > 1 ) {
                $template = $posts[0]['tipo'].'/list.phtml';
            }
            
            return $posts;
        }
    }

}