<?php

namespace Admin\Model\StatoCivile;

use Application\Model\QueryBuilderHelperAbstract;

/** 
 * @author Andrea Fiori
 * @since  26 July 2013
 */
class StatoCivileSezioniGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('scs.id, scs.nome ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', ' Application\Entity\ZfcmsComuniStatoCivileSezioni scs ')
                                ->add('where', "sca.sezione = scs.id ");

        return $this->getQueryBuilder();
    }
}
