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
        $this->setSelectQueryFields('DISTINCT(a.id) AS id, a.name, a.size, a.state, a.insertDate, a.expireDate');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsAttachments a, Application\Entity\ZfcmsAttachmentsOptions ao, Application\Entity\ZfcmsAttachmentsRelations ar ')
                                ->add('where', 'ao.attachment = a.id AND ar.attachment = a.id ');
        
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
     * @param number $moduleId
     */
    public function setModuleId($moduleId)
    {
        if ( is_numeric($moduleId) ) {
            $this->getQueryBuilder()->andWhere('ar.module = ( :moduleId ) ');
            $this->getQueryBuilder()->setParameter('moduleId', $moduleId);
        }
    }
}