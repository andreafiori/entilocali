<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\RecordsGetterAbstract;
use Admin\Model\AlboPretorio\AlboPretorioGetterWrapper;
use Admin\Model\AlboPretorio\AlboPretorioGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  27 July 2014
 */
class AlboPretorioRecordsGetter extends RecordsGetterAbstract
{
    private $alboPretorioGetterWrapper;
    
    /**
     * @param array $input
     */
    public function setArticoliInput(array $input)
    {
        $this->alboPretorioGetterWrapper = new AlboPretorioGetterWrapper( new AlboPretorioGetter($this->getInput('entityManager',1)) );
        $this->alboPretorioGetterWrapper->setInput($input);
        $this->alboPretorioGetterWrapper->setupQueryBuilder();
        
        return $this->alboPretorioGetterWrapper;
    }
    
    public function setArticoliPaginator()
    {
        $this->assertAlboPretorioGetterWrapper();
        
        $arrayQuery = $this->alboPretorioGetterWrapper->setupQuery($this->getInput('entityManager', 1));
        
        $this->alboPretorioGetterWrapper->setupPaginator($arrayQuery ? $arrayQuery : array());
        
        return $this->alboPretorioGetterWrapper;
    }
    
    public function setArticoliPaginatorCurrentPage($page = null)
    {
        $this->assertAlboPretorioGetterWrapper();
        
        $this->alboPretorioGetterWrapper->setupPaginatorCurrentPage($page);
        
        return $this->alboPretorioGetterWrapper;
    }
    
    public function setArticoliPaginatorPerPage($perpage = null)
    {
        $this->assertAlboPretorioGetterWrapper();
        
        $this->alboPretorioGetterWrapper->setupPaginatorItemsPerPage($perpage);
        
        return $this->alboPretorioGetterWrapper;
    }
    
    public function getPaginatorRecords()
    {
        $this->assertAlboPretorioGetterWrapper();
        
        return $this->alboPretorioGetterWrapper->getPaginator();
    }
    
        /**
         * @throws NullException
         */
        private function assertAlboPretorioGetterWrapper()
        {
            if (!$this->alboPretorioGetterWrapper) {
                throw new NullException('AlboPretorioGetterWrapper is not set. Use setArticoliInput before');
            }
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
     * Get distinct years for the articoli tables
     */
    public function getYears()
    {
        $this->alboPretorioGetterWrapper = new AlboPretorioGetterWrapper( new AlboPretorioGetter($this->getInput('entityManager',1)) );
        $this->alboPretorioGetterWrapper->setInput( array('fields'=>'DISTINCT(aa.anno) AS anno','orderBy'=>'aa.anno') );
        $this->alboPretorioGetterWrapper->setupQueryBuilder();
        
        $records = $this->alboPretorioGetterWrapper->getRecords();
        
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
