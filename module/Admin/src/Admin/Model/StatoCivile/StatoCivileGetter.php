<?php

namespace Admin\Model\StatoCivile;

use Application\Model\QueryBuilderHelperAbstract;

/** 
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileGetter extends QueryBuilderHelperAbstract
{
    const moduleId = 13;
    
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(sca.id) AS id, sca.titolo, sca.progressivo, '
                . 'sca.anno, sca.data, scs.id AS sezioneId, sca.scadenza, scs.nome'
                //. ', (SELECT COUNT(att) FROM Application\Entity\ZfcmsAttachments att WHERE att.id = sca.id ) AS totattach '
                );

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsComuniStatoCivileArticoli sca, Application\Entity\ZfcmsComuniStatoCivileSezioni scs ')
                                ->add('where', "sca.sezione = scs.id ");

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
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
     * @param type $text
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
}
