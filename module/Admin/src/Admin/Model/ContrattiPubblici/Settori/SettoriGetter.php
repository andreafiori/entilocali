<?php

namespace Admin\Model\ContrattiPubblici\Settori;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class SettoriGetter extends QueryBuilderHelperAbstract
{    
    public function setMainQuery()
    {
        $this->setSelectQueryFields('cs.id, cs.nome, cs.responsabile, cs.attivo ');

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsComuniContrattiSettori ', 'cs')
                                ->where('cs.id != 0 ');
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return type
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('cs.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('cs.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
}