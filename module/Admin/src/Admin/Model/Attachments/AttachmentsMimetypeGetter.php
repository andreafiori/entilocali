<?php

namespace Admin\Model\Attachments;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
class AttachmentsMimetypeGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('a.id, a.mimetype');

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsAttachmentsMimeType ', 'a')
                                ->where('a.id != 0');
        
        return $this->getQueryBuilder();
    }

    /**
     * @param $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('a.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('a.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param $mimetype
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMimeType($mimetype)
    {
        if ( !empty($mimetype) ) {
            $this->getQueryBuilder()->andWhere('a.mimetype = :mimetype ');
            $this->getQueryBuilder()->setParameter('mimetype', $mimetype);
        }

        return $this->getQueryBuilder();
    }
}
