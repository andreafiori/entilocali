<?php

namespace Admin\Model\ContrattiPubblici;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  14 August 2014
 */
class ContrattiPubbliciGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(cc.id) AS id, cc.beneficiario, '
                . 'cc.titolo, cc.importo, cc.importo2, cc.dataAgg, cc.dataContratto, '
                . 'cc.progressivo, cc.anno, cc.data, cc.ora, cc.attivo, cc.scadenza, cc.cig ');

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsComuniContratti', 'cc')
                                ->join('cc.scContr', 'csc')
                                ->add('where', ' (cc.scContr = csc.id) ');
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return type
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('cc.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('cc.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
}
