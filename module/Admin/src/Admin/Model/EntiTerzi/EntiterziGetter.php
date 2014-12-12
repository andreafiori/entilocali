<?php

namespace Admin\Model\Entiterzi;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class EntiTerziGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('ret.id, ret.nome, ret.email ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsComuniRubricaEntiTerzi ret ')
                                ->add('where', 'ret.id != 0 ');
        
        return $this->getQueryBuilder();
    }
   
    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('ret.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('ret.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
}

