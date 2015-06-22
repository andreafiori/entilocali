<?php

namespace ModelModule\Model\Newsletter;

use ModelModule\Model\QueryBuilderHelperAbstract;

class NewsletterGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields("newsletter.id, newsletter.title, newsletter.messageText, newsletter.createDate,
                                     newsletter.format, newsletter.sent
                                    ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
            ->from('Application\Entity\ZfcmsNewsletter', 'newsletter')
            ->where('newsletter.id != 0');

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('newsletter.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('newsletter.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param $sent
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSent($sent)
    {
        if ( is_numeric($sent)) {
            $this->getQueryBuilder()->andWhere('newsletter.sent = :sent ');
            $this->getQueryBuilder()->setParameter('sent', $sent);
        }

        return $this->getQueryBuilder();
    }
}