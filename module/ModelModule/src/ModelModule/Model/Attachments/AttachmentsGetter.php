<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\QueryBuilderHelperAbstract;

/**
 * Attachments Getter
 */
class AttachmentsGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(a.id) AS id, a.name, a.size, a.status, a.insertDate,
                                      a.attiConcessioneColonna, a.title, a.description, a.expireDate, a.position,
                                      am.image, am.mimetype,
                                      u.name AS username, u.surname,
                                      mods.code AS moduleCode
                                    ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->add('from', 'Application\Entity\ZfcmsAttachmentsRelations ar')
                                ->join('ar.module', 'mods')
                                ->join('ar.attachment', 'a')
                                ->join('a.user', 'u')
                                ->join('a.mime', 'am')
                                ->join('a.language', 'languages')
                                ->where('a.user = u.id AND a.mime = am.id AND a.language = languages.id
                                            AND ar.module = mods.id
                                        ');

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
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

    /**
     * @param int $noScaduti
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setNoScaduti($noScaduti)
    {
        if ($noScaduti == 1) {
            $this->getQueryBuilder()->andWhere("( a.expireDate > '".date("Y-m-d H:i:s")."'
            OR a.expireDate = '0000-00-00 00:00:00' ) ");
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param number $languageId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLanguageId($languageId = null)
    {
        if (is_numeric($languageId)) {
            $this->getQueryBuilder()->andWhere('languages.id = :language ');
            $this->getQueryBuilder()->setParameter('language', $languageId);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $langAbbr
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLanguageAbbreviation($langAbbr)
    {
        if (!empty($langAbbr)) {
            $this->getQueryBuilder()->andWhere('languages.abbreviation1 = :languageAbbr ');
            $this->getQueryBuilder()->setParameter('languageAbbr', $langAbbr);
        }

        return $this->getQueryBuilder();
    }
}
