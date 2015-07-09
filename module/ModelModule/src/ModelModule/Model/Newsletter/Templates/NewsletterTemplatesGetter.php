<?php

namespace ModelModule\Model\Newsletter\Templates;

use ModelModule\Model\QueryBuilderHelperAbstract;

class NewsletterTemplatesGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields("newsltempl.id ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
            ->from('Application\Entity\ZfcmsNewsletterTemplates', 'newsltempl')
            ->where('newsltempl.id != 0');

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('newsltempl.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('newsltempl.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }
}