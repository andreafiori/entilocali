<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  24 July 2014
 */
class AlboPretorioSezioniGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(aps.id) AS id, aps.nome, aps.attivo, aps.dest, aps.del, aps.det');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsComuniAlboSezioni aps ')
                                ->add('where', 'aps.id != 0 '); 
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $id
     * @return type
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