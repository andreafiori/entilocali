<?php

namespace ModelModule\Model\Users\Todo;

use ModelModule\Model\QueryBuilderHelperAbstract;

class UsersTodoGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('toDo.id, toDo.taskName, toDo.expiredate ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsUsersTodo', 'toDo')
                                ->join('toDo.user', 'user')
                                ->where("toDo.user = user.id ");

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('toDo.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('toDo.id IN ( :id ) ');
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
            $this->getQueryBuilder()->andWhere('toDo.user = :userId ');
            $this->getQueryBuilder()->setParameter('userId', $id);
        }

        return $this->getQueryBuilder();
    }
}