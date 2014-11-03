<?php

namespace Admin\Model\Config;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  01 November 2014
 */
class ConfigGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('c.name, c.value ');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\ZfcmsConfig c')
                                ->add('where', 'c.channelId IN ( :channel , 0 ) AND c.languageId IN ( :language , 0 )');
        
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
        if ( !isset($languageId) or !  is_numeric($languageId) ) {
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
        if (isset($name)) {
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
        if (isset($value)) {
            $this->getQueryBuilder()->andWhere('c.value = :value ');
            $this->getQueryBuilder()->setParameter('value', $value);
        }
        
        return $this->getQueryBuilder();
    }
}