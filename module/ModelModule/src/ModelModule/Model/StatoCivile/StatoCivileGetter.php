<?php

namespace ModelModule\Model\StatoCivile;

use ModelModule\Model\QueryBuilderHelperAbstract;

class StatoCivileGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("DISTINCT(sca.id) AS id, sca.titolo, sca.progressivo,
                                    sca.anno, sca.data, sca.homepageFlag, sca.boxNotizie,

                                    scs.id AS sezioneId, sca.scadenza, scs.nome AS nomeSezione, sca.attivo,

                                    ( SELECT CONCAT(u.name, ' ', u.surname) FROM Application\Entity\ZfcmsUsers u
                                    WHERE u.id = sca.utente ) AS user_name_surname

                                    ");

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsComuniStatoCivileArticoli', 'sca')
                                ->join('sca.sezione', 'scs')
                                ->where("sca.sezione = scs.id ");

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number|array $id
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
    
    /**
     * @param number $numero_progressivo
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setProgressivo($numero_progressivo)
    {
        if ( is_numeric($numero_progressivo) ) {
            $this->getQueryBuilder()->andWhere('sca.progressivo = :numero_progressivo ');
            $this->getQueryBuilder()->setParameter('numero_progressivo', $numero_progressivo);
        }
        
        if (is_array($numero_progressivo)) {
            $this->getQueryBuilder()->andWhere('sca.progressivo IN ( :numero_progressivo ) ');
            $this->getQueryBuilder()->setParameter('numero_progressivo', $numero_progressivo);
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
            $this->getQueryBuilder()->andWhere('sca.anno = :anno ');
            $this->getQueryBuilder()->setParameter('anno', $anno);
        }

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number|string $scadenza
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setScadenza($scadenza)
    {
        if ($scadenza) {
            $this->getQueryBuilder()->andWhere('sca.scadenza > NOW() ');
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number $sezioneId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSezioneId($sezioneId)
    {
        if ( is_numeric($sezioneId) ) {
            $this->getQueryBuilder()->andWhere('scs.id = :sezioneId ');
            $this->getQueryBuilder()->setParameter('sezioneId', $sezioneId);
        }

        return $this->getQueryBuilder();
    }
    
    /**
     * @param string $text
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setTextSearch($text)
    {
        if ($text) {
            $this->getQueryBuilder()->andWhere('sca.titolo LIKE :textSearch ');
            $this->getQueryBuilder()->setParameter('textSearch', "%$text%");
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param int $noScaduti
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setNoScaduti($noScaduti)
    {
        if ($noScaduti == 1) {
            $this->getQueryBuilder()->andWhere("( sca.scadenza > '".date("Y-m-d H:i:s")."'
            OR sca.scadenza = '0000-00-00 00:00:00') ");
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
            $this->getQueryBuilder()->andWhere("sca.attivo = :attivo ");
            $this->getQueryBuilder()->setParameter('attivo', $attivo);
        }

        return $this->getQueryBuilder();
    }
}
