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
        $this->setSelectQueryFields('DISTINCT(p.id) AS postid, po.id AS postoptionid, p.dataUltimoAggiornamento, p.dataInserimento, p.dataScadenza, p.tipo, p.alias, po.titolo, po.stato, po.descrizione, po.seoUrl, po.sottotitolo, po.seoDescription, po.seoKeywords, p.templateFile, p.flagAllegati, co.nome AS nomeCategoria, c.template, IDENTITY(r.modulo) AS modulo');

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
    public function setNomeCategoria($category)
    {
        if ( is_string($category) ) {
            $this->getQueryBuilder()->andWhere('co.nome = LOWER( :nome_categoria ) ');
            $this->getQueryBuilder()->setParameter('nome_categoria', Slugifier::deSlugify($category) );
        }
        
        return $this->getQueryBuilder();
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
        
        return $this->getQueryBuilder();
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
        
        return $this->getQueryBuilder();
    }
       
    /**
     * Set posts status
     * 
     * @param string or null $status
     */
    public function setStato($status = null)
    {
        if ($status == 'NULL' or $status == 'null') {
            $this->getQueryBuilder()->andWhere('po.stato IS NULL ');
        } elseif ($status != null) {
            $this->getQueryBuilder()->andWhere("po.stato = '$status' ");
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
        
        $postsRelazioni = new PostsRelazioniGetter($this->getEntityManager());
        
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
            
            
            $postsRelazioni->setSelectQueryFields('IDENTITY(r.categoria) AS categorie');
            $postsRelazioni->setMainQuery();
            $postsRelazioni->setChannelId(isset($channel) ? $channel : 1);
            $postsRelazioni->setModuloId($posts[$i]['modulo']);
            $postsRelazioni->setPostsId($posts[$i]['postoptionid']);
            $categories = $postsRelazioni->getQueryResult();
            foreach ($categories as $categoria) {
                $posts[$i]['categorie'][] = $categoria['categorie'];
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
