<?php

namespace Admin\Model\StatoCivile;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\StatoCivile\StatoCivileSezioniGetter;

/** 
 * @author Andrea Fiori
 * @since  26 July 2013
 */
class StatoCivileSezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\StatoCivile\StatoCivileSezioniGetter **/
    protected $objectGetter;

    /**
     * @param \Admin\Model\StatoCivile\StatoCivileSezioniGetter $statoCivileSezioniGetter
     */
    public function __construct(StatoCivileSezioniGetter $statoCivileSezioniGetter)
    {
        $this->setObjectGetter($statoCivileSezioniGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
    }
}