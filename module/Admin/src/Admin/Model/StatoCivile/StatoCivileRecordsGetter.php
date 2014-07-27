<?php

namespace Admin\Model\StatoCivile;

use Application\Model\RecordsGetterAbstract;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Admin\Model\StatoCivile\StatoCivileSezioniGetter;
use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  27 July 2013
 */
class StatoCivileRecordsGetter extends RecordsGetterAbstract
{
    /**
     * Set Articoli Stato Civile as recordset
     * 
     * @param type $input
     */
    public function setArticoli(array $input)
    {
        $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager',1)) );
        $statoCivileGetterWrapper->setInput($input);
        $statoCivileGetterWrapper->setupQueryBuilder();

        $this->setRecords( $statoCivileGetterWrapper->getRecords() );
    }
    
    /**
     * Set Articoli Stato Civile Sezioni as recordset
     * 
     * @param type $input
     */
    public function setSezioni(array $input)
    {
        $statoCivileSezioniGetterWrapper = new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($this->getInput('entityManager',1)) );
        $statoCivileSezioniGetterWrapper->setInput($input);
        $statoCivileSezioniGetterWrapper->setupQueryBuilder();

        $this->setRecords( $statoCivileSezioniGetterWrapper->getRecords() );
    }
}