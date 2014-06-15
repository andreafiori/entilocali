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
        $this->setSelectQueryFields('DISTINCT(u.id) AS id, u.name, u.surname, u.email, u.status, u.lastUpdate ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsUsers u')
                                ->add('where', "u.id!='' "); 

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
     * @param string or null $status
     */
    public function setStatus($status = null)
    {
        if ($status == 'NULL' or $status == 'null') {
            $this->getQueryBuilder()->andWhere("u.status = 'active' ");
        } elseif ($status != null) {
            $this->getQueryBuilder()->andWhere("u.status = '$status' ");
        }
    }
}

