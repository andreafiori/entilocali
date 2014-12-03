<?php

namespace Application\Model\HomePage;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  22 June 2014
 */
class HomePageRecordsGetterWrapper extends RecordsGetterWrapperAbstract
{
    private $hompageRecordsGetter;
    
    /**
     * @param HompageRecordsGetter $hompageRecordsGetter
     */
    public function __construct(HomePageRecordsGetter $hompageRecordsGetter)
    {
        $this->setObjectGetter($hompageRecordsGetter);
        
        $this->hompageRecordsGetter = $this->getObjectGetter();
    }
    
    public function setupQueryBuilder()
    {
        $this->hompageRecordsGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->hompageRecordsGetter->setMainQuery();
        
        $this->hompageRecordsGetter->setOrderBy( $this->getInput('orderBy', 1), 'hb.position' );
        $this->hompageRecordsGetter->setLimit( $this->getInput('limit', 1) );
    }
    
    /**
     * @return array or null
     */
    public function getRecords()
    {
        $homePageRecords = $this->hompageRecordsGetter->getQueryResult();
        
        if (is_array($homePageRecords)) {
            $arrayHomePageRecords = array();
            foreach($homePageRecords as $homePageRecord) {
                if ( isset($homePageRecord['moduleId']) ) {
                    $arrayHomePageRecords[$homePageRecord['moduleId']][] = $homePageRecord;
                }
            }
            
            return $arrayHomePageRecords;
        }
        
        return null;
    }
}
