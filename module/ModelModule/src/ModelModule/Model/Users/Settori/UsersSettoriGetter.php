<?php

namespace ModelModule\Model\Users\Settori;

use ModelModule\Model\QueryBuilderHelperAbstract;

class UsersSettoriGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('settore.id, settore.nome, u.name, u.surname,
                                    IDENTITY(settore.responsabileUser) AS responsabileUserId
                                    ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsUsersSettori', 'settore')
                                ->join('settore.responsabileUser', 'u')
                                ->where(" (settore.responsabileUser = u.id ) ");

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('settore.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('settore.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }
}