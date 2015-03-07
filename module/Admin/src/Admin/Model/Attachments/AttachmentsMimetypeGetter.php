<?php

namespace Admin\Model\Attachments;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
class AttachmentsMimetypeGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('a.id, a.mimetype');

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsAttachmentsMimeType ', 'a')
                                ->where('a.id != 0');
        
        return $this->getQueryBuilder();
    }

    /**
     * @param number or array $id
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
     * @param string $mimetype
     */
    public function setMimeType($mimetype)
    {
        if ( !empty($mimetype) ) {
            $this->getQueryBuilder()->andWhere('a.mimetype = :mimetype ');
            $this->getQueryBuilder()->setParameter('mimetype', $mimetype);
        }
    }
}
