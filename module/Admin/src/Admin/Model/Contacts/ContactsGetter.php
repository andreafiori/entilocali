<?php

namespace Admin\Model\Contacts;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 June 2014
 */
class ContactsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(c.id) AS id, c.name, c.surname, c.email, c.phone, c.message, c.insertDate, c.format, c.status');

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsContacts', 'c')
                                ->where("c.id != '' ");

        return $this->getQueryBuilder();
    }
    
    /**
     * @param int|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('c.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('c.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param string $email
     */
    public function setEmail($email=null)
    {
        if (is_string($email)) {
            $this->getQueryBuilder()->andWhere('c.email = :email ');
            $this->getQueryBuilder()->setParameter('email', $email);
        }
    }
    
    /**
     * @param string $email
     */
    public function setSurname($surname=null)
    {
        if (is_string($surname)) {
            $this->getQueryBuilder()->andWhere('c.surname = :surname ');
            $this->getQueryBuilder()->setParameter('surname', $surname);
        }
    }
}
