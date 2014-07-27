<?php

namespace Admin\Model\StatoCivile;

use Application\Model\QueryBuilderHelperAbstract;

/** 
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(sca.id) AS id, sca.titolo, sca.progressivo, sca.anno, sca.data, scs.id AS sezioneId, sca.scadenza, scs.nome ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsComuniStatoCivileArticoli sca, Application\Entity\ZfcmsComuniStatoCivileSezioni scs ')
                                ->add('where', "sca.sezione = scs.id ");

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return type
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
     * @param number or string $scadenza
     */
    public function setScadenza($scadenza)
    {
        if ($scadenza) {
            $this->getQueryBuilder()->andWhere('sca.scadenza > NOW() ');
        }
    }
}
