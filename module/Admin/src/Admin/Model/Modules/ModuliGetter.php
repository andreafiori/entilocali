<?php

namespace Admin\Model\Modules;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  30 May 2014
 */
class ModulesGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->getQueryBuilder()->add('select', 'm.code, m.name, m.status')
                                ->add('from', 'Application\Entity\Modules m')
                                ->add('where', '');

        return $this->getQueryBuilder();
    }
}