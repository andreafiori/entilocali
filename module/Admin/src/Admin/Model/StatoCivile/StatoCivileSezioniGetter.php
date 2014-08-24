<?php

namespace Admin\Model\StatoCivile;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  26 July 2013
 */
class StatoCivileSezioniGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('scs.id, scs.nome, scs.dataInserimento, scs.dataUltimoAggiornamento ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', ' Application\Entity\ZfcmsComuniStatoCivileSezioni scs ')
                                ->add('where', "scs.id != '0' ");

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sca.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('sca.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
}
