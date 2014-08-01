<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\RecordsGetterAbstract;
use Admin\Model\AlboPretorio\AlboPretorioGetter;
use Admin\Model\AlboPretorio\AlboPretorioGetterWrapper;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  27 July 2014
 */
class AlboPretorioRecordsGetter extends RecordsGetterAbstract
{
    /**
     * @param type $input
     */
    public function setArticoli(array $input)
    {
        $alboPretorioGetterWrapper = new AlboPretorioGetterWrapper( new AlboPretorioGetter($this->getInput('entityManager',1)) );
        $alboPretorioGetterWrapper->setInput($input);
        $alboPretorioGetterWrapper->setupQueryBuilder();

        $this->setRecords( $alboPretorioGetterWrapper->getRecords() );
    }
    
    /**
     * @param type $input
     */
    public function setSezioni(array $input)
    {
        $alboPretorioSezioniGetterWrapper = new AlboPretorioSezioniGetterWrapper( new AlboPretorioSezioniGetter($this->getInput('entityManager',1)) );
        $alboPretorioSezioniGetterWrapper->setInput($input);
        $alboPretorioSezioniGetterWrapper->setupQueryBuilder();

        $this->setRecords( $alboPretorioSezioniGetterWrapper->getRecords() );
    }
    
    /**
     * @param array $input
     */
    public function setSettori(array $input)
    {
        $usersGetterWrapper = new UsersGetterWrapper( new UsersGetter($this->getInput('entityManager', 1)) );
        $usersGetterWrapper->setInput($input);
        $usersGetterWrapper->setupQueryBuilder();

        $this->setRecords( $usersGetterWrapper->getRecords() );
    }
    
    /**
     * Given atti records, set anno => anno array for the form select
     * 
     * @param array $records
     */
    public function getYears(array $records)
    {
        $toReturn = array();
        foreach($records as $record) {
            $toReturn[$record['anno']] = $record['anno'];
        }
        asort($toReturn);
        return $toReturn;
    }
}