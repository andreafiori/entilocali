<?php

namespace Admin\Model\Moduli;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  30 May 2014
 */
class ModuliGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->getQueryBuilder()->add('select', 'm.codice, m.nome, m.status')
                                ->add('from', 'Application\Entity\Moduli m')
                                ->add('where', '');

        return $this->getQueryBuilder();
    }
}