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
        $this->setSelectQueryFields('DISTINCT(u.id) AS id, u.name, u.surname, u.email, u.address, u.status, u.zip, u.city, u.username, u.lastUpdate, u.settore ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsUsers u')
                                ->join('u.role', 'ur')
                                ->where("(u.role = ur.id) ");

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return type
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
     */
    public function setSurname($surname)
    {
        if ( is_string($surname) ) {
            $this->getQueryBuilder()->andWhere('u.surname = :surname ');
            $this->getQueryBuilder()->setParameter('surname', $surname);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param string $email
     */
    public function setEmail($email = null)
    {
        if ($email) {
            $this->getQueryBuilder()->andWhere("u.email = :email ");
            $this->getQueryBuilder()->setParameter('email', $email);
        }
    }
    
    /**
     * @param string $username
     */
    public function setUsername($username = null)
    {
        if ( $username ) {
            $this->getQueryBuilder()->andWhere("u.username = :username ");
            $this->getQueryBuilder()->setParameter('username', $username);
        }
    }

    /**
     * Set password (encoded)
     * 
     * @param string $password
     */
    public function setPassword($password = null)
    {
        if ($password) {
            $this->getQueryBuilder()->andWhere("u.password = :password ");
            $this->getQueryBuilder()->setParameter('password', md5($password) );
        }
    }
    
    /**
     * @param string or null $status
     */
    public function setStatus($status = null)
    {
        if (!$status) {
            $status = 'active';
        }
        
        $this->getQueryBuilder()->andWhere("u.status = :status ");
        $this->getQueryBuilder()->setParameter('status', $status);
    }
    
    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        if ($apiKey) {
            $this->getQueryBuilder()->andWhere("u.status = :status ");
            $this->getQueryBuilder()->setParameter('apiKey', $apiKey);
        }
    }
}
