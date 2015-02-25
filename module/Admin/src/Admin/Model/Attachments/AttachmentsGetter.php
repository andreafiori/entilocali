<?php

namespace Admin\Model\Attachments;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  25 July 2014
 */
class AttachmentsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(a.id) AS id, a.name, a.size, a.state, a.insertDate,
                                      ao.title, ao.description,
                                      am.image, am.mimetype,

                                      u.name AS username, u.surname
                                    ');
        
        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->add('from', '
                                       Application\Entity\ZfcmsAttachments a, 
                                       Application\Entity\ZfcmsAttachmentsOptions ao, 
                                       Application\Entity\ZfcmsAttachmentsRelations ar,
                                       Application\Entity\ZfcmsAttachmentsMimeType am,
                                       Application\Entity\ZfcmsUsers u
                                ')
                                ->where(' ao.attachment = a.id AND ar.attachment = a.id AND a.user = u.id AND a.mime = am.id ');

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
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
     * @param int $moduleId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setModuleId($moduleId)
    {
        if ( is_numeric($moduleId) ) {
            $this->getQueryBuilder()->andWhere('ar.module = ( :moduleId ) ');
            $this->getQueryBuilder()->setParameter('moduleId', $moduleId);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $referenceId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setReferenceId($referenceId)
    {
        if ( is_numeric($referenceId) ) {
            $this->getQueryBuilder()->andWhere('ar.referenceId = ( :referenceId ) ');
            $this->getQueryBuilder()->setParameter('referenceId', $referenceId);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $attachmentId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAttachmentId($attachmentId)
    {
        if ( is_numeric($attachmentId) ) {
            $this->getQueryBuilder()->andWhere('ar.attachment = ( :attachmentId ) ');
            $this->getQueryBuilder()->setParameter('attachmentId', $attachmentId);
        }

        return $this->getQueryBuilder();
    }
}
