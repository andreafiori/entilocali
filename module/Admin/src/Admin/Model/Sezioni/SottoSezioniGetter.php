<?php

namespace Admin\Model\Sezioni;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 January 2015
 */
class SottoSezioniGetter extends QueryBuilderHelperAbstract
{
    const moduleId = 13;
    
    public function setMainQuery()
    {
        $this->setSelectQueryFields("subs.id, subs.nome, subs.posizione, subs.urlTitle ");

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsComuniSottosezioni', 'subs')
                                ->join('subs.sezione', 'sezione')
                                ->where("subs.sezione = sezione.id ");

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('subs.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('subs.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param string $slug
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSlug($slug)
    {
        if ( isset($sezioneId) ) {
            $this->getQueryBuilder()->andWhere('subs.slug = :slug ');
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
            $this->getQueryBuilder()->andWhere('subs.sezione = :sezioneId ');
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
            $this->getQueryBuilder()->andWhere('subs.isSs = :isSs ');
            $this->getQueryBuilder()->setParameter('isSs', $isSottoSezione);
        }

        return $this->getQueryBuilder();
    }
}