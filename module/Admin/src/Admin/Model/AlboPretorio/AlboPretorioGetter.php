<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  07 July 2014
 */
class AlboPretorioGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(aa.id) AS id, aa.numeroProgressivo, aa.numeroAtto, aa.anno, aa.titolo, aa.dataAttivazione, aa.oraAttivazione ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsComuniAlboArticoli aa, Application\Entity\ZfcmsComuniAlboSezioni aps ')
                                ->add('where', 'aa.sezione = aps.id '); 
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return type
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('aa.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('aa.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $numeroProgressivo
     */
    public function setNumeroProgressivo($numeroProgressivo)
    {
        if ( is_numeric($numeroProgressivo) ) {
            $this->getQueryBuilder()->andWhere('aa.numeroProgressivo = :numeroProgressivo ');
            $this->getQueryBuilder()->setParameter('numeroProgressivo', $numeroProgressivo);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $numeroProgressivo
     */
    public function setNumeroAtto($numeroAtto)
    {
        if ( is_numeric($numeroAtto) ) {
            $this->getQueryBuilder()->andWhere('aa.numeroAtto = :numeroAtto ');
            $this->getQueryBuilder()->setParameter('numeroAtto', $numeroAtto);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param date $dataScadenza
     */
    public function setDataScadenza($dataScadenza)
    {
        if ( is_numeric($dataScadenza) ) {
            $this->getQueryBuilder()->andWhere('aa.dataScadenza = :dataScadenza ');
            $this->getQueryBuilder()->setParameter('dataScadenza', $dataScadenza);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * if flag is set, do not show expired articoli
     * 
     * @param 0 or 1 $flag
     */
    public function setDoNotExpired($flag)
    {
        if ($flag) {
            
        }
    }
    
}
