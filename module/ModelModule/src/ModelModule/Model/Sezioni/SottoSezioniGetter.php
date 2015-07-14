<?php

namespace ModelModule\Model\Sezioni;

use ModelModule\Model\QueryBuilderHelperAbstract;

class SottoSezioniGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("sottosezioni.id AS idSottoSezione, IDENTITY(sottosezioni.sezione) AS sezione,
            sottosezioni.nome AS nomeSottoSezione, sottosezioni.immagine, sezioni.id AS idSezione, sezioni.nome AS nomeSezione,
            IDENTITY(sottosezioni.profonditaDa) AS profonditaDa, sottosezioni.profonditaA, sottosezioni.url, sottosezioni.attivo,
            sottosezioni.url, sottosezioni.urlTitle, sottosezioni.posizione, sottosezioni.isAmmTrasparente
        ");

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsComuniSottosezioni', 'sottosezioni')
                                ->join('sottosezioni.sezione', 'sezioni')
                                ->join('sezioni.modulo', 'modulo')
                                ->join('sezioni.lingua', 'languages')
                                ->where("sottosezioni.sezione = sezioni.id ");

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sottosezioni.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('sottosezioni.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setExcludeId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezioni.id != :excludeId ');
            $this->getQueryBuilder()->setParameter('excludeId', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('sezioni.id NOT IN ( :excludeId ) ');
            $this->getQueryBuilder()->setParameter('excludeId', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setExcludeSezioneId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezioni.id != :excludeSezioneId ');
            $this->getQueryBuilder()->setParameter('excludeSezioneId', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('sezioni.id NOT IN ( :excludeSezioneId ) ');
            $this->getQueryBuilder()->setParameter('excludeSezioneId', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $slug
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSlug($slug)
    {
        if ( isset($slug) ) {
            $this->getQueryBuilder()->andWhere('sottosezioni.slug = :slug ');
            $this->getQueryBuilder()->setParameter('slug', $slug);
        }

        return $this->getQueryBuilder();
    }
    
    /**
     * @param int $sezioneId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSezioneId($sezioneId)
    {
        if (is_numeric($sezioneId) ) {
            $this->getQueryBuilder()->andWhere('sottosezioni.sezione = :sezioneId ');
            $this->getQueryBuilder()->setParameter('sezioneId', $sezioneId);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $isSottoSezione
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setIsSs($isSottoSezione)
    {
        if (is_numeric($isSottoSezione) ) {
            $this->getQueryBuilder()->andWhere('sottosezioni.isSs = :isSs ');
            $this->getQueryBuilder()->setParameter('isSs', $isSottoSezione);
        }

        return $this->getQueryBuilder();
    }
    
    /**    
     * @param int $profonditaDa
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setProfonditaDa($profonditaDa)
    {
        if (is_numeric($profonditaDa) ) {
            $this->getQueryBuilder()->andWhere('sottosezioni.profonditaDa = :profonditaDa ');
            $this->getQueryBuilder()->setParameter('profonditaDa', $profonditaDa);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $profonditaDa
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setProfonditaDaAsNull($profonditaDa)
    {
        if (is_numeric($profonditaDa) ) {
            $this->getQueryBuilder()->andWhere("( sottosezioni.profonditaDa IS NULL OR sottosezioni.profonditaDa = '' ) ");
        }

        return $this->getQueryBuilder();
    }

    /**    
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setModulo($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('sezioni.modulo = :moduloId ');
            $this->getQueryBuilder()->setParameter('moduloId', $id);
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
            $this->getQueryBuilder()->andWhere('sottosezioni.attivo = :attivo ');
            $this->getQueryBuilder()->setParameter('attivo', $attivo);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $lingua
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLinguaId($lingua)
    {
        if ( !empty($lingua) ) {
            $this->getQueryBuilder()->andWhere('sezioni.lingua = :linguaId ');
            $this->getQueryBuilder()->setParameter('linguaId', $lingua);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $abbreviation
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLanguageAbbreviation($abbreviation)
    {
        if ( !empty($abbreviation) ) {
            $this->getQueryBuilder()->andWhere('languages.abbreviation1 = :languageAbbreviation ');
            $this->getQueryBuilder()->setParameter('languageAbbreviation', $abbreviation);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $isAmmTrasparente
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setIsAmmTrasparente($isAmmTrasparente)
    {
        if ( is_numeric($isAmmTrasparente) ) {
            $this->getQueryBuilder()->andWhere('sottosezioni.isAmmTrasparente = :isammtrasp AND sezioni.isAmmTrasparente = :isammtrasp ');
            $this->getQueryBuilder()->setParameter('isammtrasp', $isAmmTrasparente);
        }

        return $this->getQueryBuilder();
    }

    /**
     * Free text research
     *
     * @param string $search
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setFreeSearch($search)
    {
        if (!empty($search)) {
            $search = strtolower($search);

            $this->getQueryBuilder()->andWhere(' ( LOWER(sottosezioni.nome) LIKE :freeSearch OR
            LOWER(sezioni.nome) LIKE :freeSearch ) ');
            $this->getQueryBuilder()->setParameter('freeSearch', "%".$search."%");
        }

        return $this->getQueryBuilder();
    }
}
