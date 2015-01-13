<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  07 July 2014
 */
class AlboPretorioArticoliGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("DISTINCT(aa.id) AS id, aa.numeroProgressivo, aa.numeroAtto, 
                aa.anno, aa.titolo, 
                aa.dataPubblicare, aa.dataAttivazione, aa.oraAttivazione, aa.dataScadenza, 
                aa.enteTerzo, 
                aa.attivo,
                aa.checkRettifica,
                IDENTITY(aa.sezione) AS sezione,
                aps.id AS idSezione, aps.nome AS nomeSezione,
                aa.pubblicare,
                aa.annullato,
                u.id AS iduser, u.name AS userName, u.surname AS userSurname, u.settore
        ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsComuniAlboArticoli', 'aa')
                                ->join('aa.sezione', 'aps')
                                ->join('aa.utente', 'u')
                                ->where('aa.sezione = aps.id ');
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return \Doctrine\ORM\QueryBuilder
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
     * @return \Doctrine\ORM\QueryBuilder
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
     * @param number $numeroAtto
     * @return \Doctrine\ORM\QueryBuilder
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
     * @param string $mese
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMese($mese)
    {
        if ( is_numeric($mese) ) {
            $this->getQueryBuilder()->andWhere('MONTH(aa.dataPubblicare) = :mese ');
            $this->getQueryBuilder()->setParameter('mese', $mese);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $anno
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAnno($anno)
    {
        if ( is_numeric($anno) ) {
            $this->getQueryBuilder()->andWhere('aa.anno = :anno ');
            $this->getQueryBuilder()->setParameter('anno', $anno);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param date|string $dataScadenza
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setDataScadenza($dataScadenza)
    {
        if ($dataScadenza) {
            $this->getQueryBuilder()->andWhere('aa.dataScadenza = :dataScadenza ');
            $this->getQueryBuilder()->setParameter('dataScadenza', $dataScadenza);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSezioneId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('aa.sezione = :sezioneId ');
            $this->getQueryBuilder()->setParameter('sezioneId', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param int $name
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSettore($name)
    {
        if ($name) {
            $this->getQueryBuilder()->andWhere('u.settoreId = :settoreId ');
            $this->getQueryBuilder()->setParameter('settoreId', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setUtenteId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('aa.utente = :utenteId ');
            $this->getQueryBuilder()->setParameter('utenteId', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param string $annulled
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAnnullato($annulled)
    {
        if ( isset($annulled) ) {
            $this->getQueryBuilder()->andWhere('aa.annullato = :annullato ');
            $this->getQueryBuilder()->setParameter('annullato', $annulled);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param int $pubblicare
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setPubblicare($pubblicare)
    {
        if ( is_numeric($pubblicare) ) {
            $this->getQueryBuilder()->andWhere('aa.pubblicare = :pubblicare ');
            $this->getQueryBuilder()->setParameter('pubblicare', $pubblicare);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param int $attivo
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAttivo($attivo)
    {
        if ( is_numeric($attivo) ) {
            $this->getQueryBuilder()->andWhere('aa.attivo = :attivo ');
            $this->getQueryBuilder()->setParameter('attivo', $attivo);
        }
        
        return $this->getQueryBuilder();
    }
}
