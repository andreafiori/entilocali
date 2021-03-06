<?php

namespace ModelModule\Model\Config;

use ModelModule\Model\QueryBuilderHelperAbstract;

class ConfigGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('c.name, c.value ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsConfig', 'c')
                                ->where('c.channelId IN ( :channel , 0 ) AND IDENTITY(c.language) IN ( :language , 0 )');
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number|array $channel
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setChannel($channel = 1)
    {
        if ( !isset($channel) or !  is_numeric($channel) ) {
            $channel = 1;
        }
        
        $this->getQueryBuilder()->setParameter('channel', $channel);
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param number|array $languageId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLanguage($languageId)
    {
        if ( !empty($languageId) or !is_numeric($languageId) ) {
            $languageId = 1;
        }
        
        $this->getQueryBuilder()->setParameter('language', $languageId);
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param string $name
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setName($name)
    {
        if (!empty($name)) {
            $this->getQueryBuilder()->andWhere('c.name = :name ');
            $this->getQueryBuilder()->setParameter('name', $name);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**
     * @param string $value
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setValue($value)
    {
        if (!empty($value)) {
            $this->getQueryBuilder()->andWhere('c.value = :value ');
            $this->getQueryBuilder()->setParameter('value', $value);
        }
        
        return $this->getQueryBuilder();
    }
    
    /**     
     * @param int $isBackend
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setIsBackend($isBackend)
    {
        if (is_numeric($isBackend)) {
            $this->getQueryBuilder()->andWhere('c.isBackend = :isBackend ');
            $this->getQueryBuilder()->setParameter('isBackend', $isBackend);
        }
        
        return $this->getQueryBuilder();
    }
}