<?php

namespace ModelModule\Model\StatoCivile;

use ModelModule\Model\RecordsGetterAbstract;

/**
 * @author Andrea Fiori
 * @since  27 July 2013
 */
class StatoCivileRecordsGetter extends RecordsGetterAbstract
{
    /**
     * Set Recordset Articoli Stato Civile
     *
     * @param array $input
     */
    public function setArticoli(array $input)
    {
        $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager',1)) );
        $statoCivileGetterWrapper->setInput($input);
        $statoCivileGetterWrapper->setupQueryBuilder();

        $this->setRecords( $statoCivileGetterWrapper->getRecords() );
    }
    
    /**
     * Set Sezioni Stato Civile Sezioni as recordset
     *
     * @param array $input
     */
    public function setSezioni(array $input)
    {
        $statoCivileSezioniGetterWrapper = new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($this->getInput('entityManager',1)) );
        $statoCivileSezioniGetterWrapper->setInput($input);
        $statoCivileSezioniGetterWrapper->setupQueryBuilder();

        $this->setRecords( $statoCivileSezioniGetterWrapper->getRecords() );
    }
    
    public function getYears()
    {
        $articoliWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getEntityManager()) );
        $articoliWrapper->setInput( array('fields' => 'DISTINCT(sca.anno) AS anno ','orderBy' => 'sca.anno') );
        $articoliWrapper->setupQueryBuilder();
        
        $records = $articoliWrapper->getRecords();
        
        if (!$records) {
            return false;
        }
        
        $arrayYears = array();
        foreach($records as $year) {
            if (isset($year['anno'])) {
                $arrayYears[$year['anno']] = $year['anno'];
            }
        }
        
        return $arrayYears;
    }
}