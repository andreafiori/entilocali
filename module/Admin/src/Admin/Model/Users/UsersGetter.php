<?php

namespace Admin\Model\Users;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  13 June 2014
 */
class UsersGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(u.id) AS id, u.name, u.surname, u.email, u.address, u.status, u.zip,
                                      u.city, u.username, u.lastUpdate, u.passwordLastUpdate,

                                      role.id AS roleId, role.name AS roleName,

                                      settore.id AS settoreId, settore.nome,
                                      IDENTITY(settore.responsabileUser) AS responsabileUserId
                                    ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsUsers', 'u')
                                ->join('u.role', 'role')
                                ->join('u.settore', 'settore')
                                ->where("u.role = role.id ");

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('u.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('u.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $surname
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSurname($surname)
    {
        if ( is_string($surname) and !empty($surname) ) {
            $this->getQueryBuilder()->andWhere('u.surname = :surname ');
            $this->getQueryBuilder()->setParameter('surname', $surname);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $email
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setEmail($email = null)
    {
        if (!empty($email)) {
            $this->getQueryBuilder()->andWhere("u.email = :email ");
            $this->getQueryBuilder()->setParameter('email', $email);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $username
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setUsername($username)
    {
        if (!empty($username)) {
            $this->getQueryBuilder()->andWhere("u.username = :username ");
            $this->getQueryBuilder()->setParameter('username', $username);
        }

        return $this->getQueryBuilder();
    }

    /**
     * Set encoded password (md5)
     *
     * @param string $password
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setPassword($password)
    {
        if (!empty($password)) {
            $this->getQueryBuilder()->andWhere("u.password = MD5( :password ) ");
            $this->getQueryBuilder()->setParameter('password', $password);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $status
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setStatus($status)
    {
        if (!empty($status)) {
            $this->getQueryBuilder()->andWhere("u.status = :status ");
            $this->getQueryBuilder()->setParameter('status', $status);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $status
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSalt($salt)
    {
        if (!empty($salt)) {
            $this->getQueryBuilder()->andWhere("u.salt = :salt ");
            $this->getQueryBuilder()->setParameter('salt', $salt);
        }

        return $this->getQueryBuilder();
    }
}
