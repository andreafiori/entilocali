<?php

namespace ModelModule\Model\StatoCivile\Sezioni;

use ModelModule\Model\QueryBuilderHelperAbstract;

class StatoCivileSezioniGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('scs.id, scs.nome, scs.attivo, scs.dataInserimento, scs.dataUltimoAggiornamento ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniStatoCivileSezioni ', 'scs')
                                ->where("scs.id != '0' ");

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('scs.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('scs.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
}
