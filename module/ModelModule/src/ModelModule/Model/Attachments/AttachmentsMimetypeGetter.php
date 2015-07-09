<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\QueryBuilderHelperAbstract;

class AttachmentsMimetypeGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('mime.id, mime.mimetype');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsAttachmentsMimetype', 'mime')
                                ->where('mime.id != 0');
        
        return $this->getQueryBuilder();
    }

    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('mime.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('mime.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        return $this->getQueryBuilder();
    }

    /**
     * @param string $mimetype
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMimeType($mimetype)
    {
        if ( !empty($mimetype) ) {
            $this->getQueryBuilder()->andWhere('mime.mimetype = :mimetype ');
            $this->getQueryBuilder()->setParameter('mimetype', $mimetype);
        }

        return $this->getQueryBuilder();
    }
}
