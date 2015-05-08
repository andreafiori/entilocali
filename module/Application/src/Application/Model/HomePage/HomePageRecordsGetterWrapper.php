<?php

namespace Application\Model\HomePage;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  22 June 2014
 */
class HomePageRecordsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var HomePageRecordsGetter
     */
    protected $objectGetter;

    /**
     * @param HomePageRecordsGetter $objectGetter
     */
    public function __construct(HomePageRecordsGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
        
        $this->objectGetter = $this->getObjectGetter();
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setOnlyActiveModules( $this->getInput('onlyActiveModules', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1), 'hb.position ASC' );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }

    /**
     * @param array $records
     * @return array
     */
    public function formatPerModuleCode(array $records)
    {
        $recordsToReturn = array();

        foreach($records as $record) {
            if ( isset($record['moduleCode']) ) {
                $recordsToReturn[$record['moduleCode']][] = $record;
            }
        }

        return $recordsToReturn;
    }
}
