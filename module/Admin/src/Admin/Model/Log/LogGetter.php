<?php

namespace Admin\Model\Log;

use Application\Model\QueryBuilderHelperAbstract;

class LogGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('
                                    l.id, l.datetime, l.message, l.type, l.backend,

                                    u.id, u.name, u.surname
                                    ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsLogs', 'l')
                                ->join('l.user', 'u')
                                ->where('l.id != 0 ');
        
        return $this->getQueryBuilder();
    }

    /**
     * @param int|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('l.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('l.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setUserId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('u.id = :userId ');
            $this->getQueryBuilder()->setParameter('userId', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int|bool $exclude
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setExcludeErrors($exclude)
    {
        if ($exclude) {
            $this->getQueryBuilder()->andWhere("l.type != 'error' ");
        }

        return $this->getQueryBuilder();
    }
}
