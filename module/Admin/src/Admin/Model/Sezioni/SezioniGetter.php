<?php

namespace Admin\Model\Sezioni;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SezioniGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("sezioni.id, sezioni.nome, sezioni.colonna, sezioni.posizione,
                                     IDENTITY(sezioni.modulo) AS moduloId, sezioni.attivo, 
                                     sezioni.url, sezioni.title,
                                     
                                    modulo.code AS moduleCode
        ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniSezioni', 'sezioni')
                                ->join('sezioni.modulo', 'modulo')
                                ->where("sezioni.id != '' ");

        return $this->getQueryBuilder();
    }

    /**
     * @param number or array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezioni.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('sezioni.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param string $colonna
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setColonna($colonna)
    {
        if ( isset($colonna) ) {
            $this->getQueryBuilder()->andWhere('sezioni.colonna = :colonna ');
            $this->getQueryBuilder()->setParameter('colonna', $colonna);
        }

        return $this->getQueryBuilder();
    }
    
    /**
     * @param int attivo
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAttivo($attivo)
    {
        if (is_numeric($attivo) ) {
            $this->getQueryBuilder()->andWhere('sezioni.attivo = :attivo ');
            $this->getQueryBuilder()->setParameter('attivo', $attivo);
        }

        return $this->getQueryBuilder();
    }
}