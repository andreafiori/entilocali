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

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsContacts c')
                                ->add('where', "c.id != '' ");

        return $this->getQueryBuilder();
    }
    
    public function setEmail($email=null)
    {
        if (is_string($email)) {
            $this->getQueryBuilder()->andWhere('c.email = :email ');
            $this->getQueryBuilder()->setParameter('email', $email);
        }
    }
    
    public function setSurname($surname=null)
    {
        if (is_string($surname)) {
            $this->getQueryBuilder()->andWhere('c.surname = :surname ');
            $this->getQueryBuilder()->setParameter('surname', $surname);
        }
    }
}