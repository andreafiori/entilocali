<?php

namespace ModelModule\Model\Languages;

use ModelModule\Model\QueryBuilderHelperAbstract;

class LanguagesGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("languages.id, languages.name, languages.abbreviation1, languages.isDefault, languages.status");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
            ->from('Application\Entity\ZfcmsLanguages', 'languages')
            ->where("languages.id != 0 ");

        return $this->getQueryBuilder();
    }

    /**
     * @param int|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('languages.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('languages.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $abbr
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAbbreviation1($abbr)
    {
        if ( !empty($abbr) ) {
            $this->getQueryBuilder()->andWhere('languages.abbreviation1 = :abbrev1 ');
            $this->getQueryBuilder()->setParameter('abbrev1', $abbr);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $status
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setStatus($status)
    {
        if ( !empty($status) ) {
            $this->getQueryBuilder()->andWhere('languages.status = :status ');
            $this->getQueryBuilder()->setParameter('status', $status);
        }

        return $this->getQueryBuilder();
    }
}