<?php

namespace Admin\Model\ContrattiPubblici;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  14 August 2014
 */
class SceltaContraenteGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('csc.id, csc.nomeScelta, csc.attivo ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsComuniContrattiScContr csc ')
                                ->add('where', 'csc.id != 0');
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number or array $id
     * @return type
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('csc.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('csc.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return type
     */
    public function setNomeScelta($nomeScelta)
    {
        if ($nomeScelta) {
            $this->getQueryBuilder()->andWhere('csc.$nomeScelta = :nomeScelta ');
            $this->getQueryBuilder()->setParameter('nomeScelta', $nomeScelta);
        }
        
        return $this->getQueryBuilder();
    }
}