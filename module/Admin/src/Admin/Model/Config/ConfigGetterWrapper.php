<?php

namespace Admin\Model\Config;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  01 November 2014
 */
class ConfigGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var ConfigGetter
     */
    protected $objectGetter;

    /**
     * @param ConfigGetter $objectGetter
     */
    public function __construct(ConfigGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setChannel($this->getInput('channel', 1));
        $this->objectGetter->setLanguage($this->getInput('language', 1));
        $this->objectGetter->setName($this->getInput('name', 1));
        $this->objectGetter->setValue($this->getInput('value', 1));
        $this->objectGetter->setIsBackend($this->getInput('isBackend', 1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1));
        $this->objectGetter->setGroupBy($this->getInput('groupBy', 1));
        $this->objectGetter->setLimit($this->getInput('limit', 1));
    }
    
    /**
     * @param array $onfigurationsFromDb
     * @return array
     */
    public function formatNameAndValue(array $onfigurationsFromDb)
    {
        $configurations = array();
        foreach($onfigurationsFromDb as $config) {
            if ( isset($config['name']) and isset($config['value']) ) {
                $configurations[$config['name']] = $config['value'];
            }
        }
        
        return $configurations;
    }
}