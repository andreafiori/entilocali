<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\QueryBuilderHelperAbstract;

class AlboPretorioSezioniGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(aps.id) AS id, aps.nome, aps.attivo, aps.dest, aps.del, aps.det');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniAlboSezioni', 'aps')
                                ->where('aps.id != 0 ');
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('aps.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('aps.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
}
