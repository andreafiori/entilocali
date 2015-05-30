<?php

namespace ModelModule\Model\Modules;

use ModelModule\Model\QueryBuilderHelperAbstract;

class ModulesGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('module.id, module.code, module.name, module.status');
        
        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsModules', 'module')
                                ->where('module.id != 0 ');

        return $this->getQueryBuilder();
    }

    /**
     * @param bool $status
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setStatus($status)
    {
        if ( is_numeric($status) ) {
            $this->getQueryBuilder()->andWhere('m.status = :status ');
            $this->getQueryBuilder()->setParameter('status', $status);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param bool $code
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setCode($code)
    {
        if ( !empty($code) ) {
            $this->getQueryBuilder()->andWhere('module.code = :code ');
            $this->getQueryBuilder()->setParameter('code', $code);
        }

        return $this->getQueryBuilder();
    }
}