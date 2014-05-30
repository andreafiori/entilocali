<?php

namespace Application\Model\Categorie;

use Application\Model\QueryBuilderHelperAbstract;
use Application\Model\Slugifier;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class CategorieGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(c.id), c.status, co.nome ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\Categorie c, Application\Entity\CategorieOpzioni co')
                                ->add('where', 'co.categoria = c.id '); // AND co.lingua = :language

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
     * @param number $moduloId
     */
    public function setModuloId($moduloId = null)
    {
        if ( is_numeric($moduloId) ) {
            $this->getQueryBuilder()->andWhere('co.modulo = :moduloId ');
            $this->getQueryBuilder()->setParameter('moduloId', $moduloId);
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
     * @param number or array $id
     * @return type
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('c.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        } elseif (is_array($id)) {
            $this->getQueryBuilder()->andWhere('c.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
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
            $this->getQueryBuilder()->andWhere('c.stato IS NULL ');
        } elseif ($status != null) {
            $this->getQueryBuilder()->andWhere("c.stato = '$status' ");
        }
    }
    
    /**
     * @param string $orderBy
     */
    public function setOrderBy($orderBy = null)
    {
        if (!$orderBy) {
            $orderBy = 'co.posizione';
        }
        
        $this->getQueryBuilder()->add('orderBy', $orderBy);
    }
    
}
