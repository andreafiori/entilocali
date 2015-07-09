<?php

namespace ModelModule\Model\ContrattiPubblici\Operatori;

use ModelModule\Model\QueryBuilderHelperAbstract;

class OperatoriGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('operatori.id, operatori.cf, operatori.ragioneSociale, operatori.nome');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniContrattiPartecipanti', 'operatori')
                                ->where('operatori.id != 0');
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('operatori.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('operatori.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * Set IDs to exclude
     *
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setExcludeId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('operatori.id NOT IN :notInId ');
            $this->getQueryBuilder()->setParameter('notInId', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('operatori.id NOT IN ( :notInId ) ');
            $this->getQueryBuilder()->setParameter('notInId', $id);
        }

        return $this->getQueryBuilder();
    }
}