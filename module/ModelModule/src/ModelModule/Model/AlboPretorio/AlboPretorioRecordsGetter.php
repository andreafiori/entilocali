<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\RecordsGetterAbstract;
use ModelModule\Model\NullException;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;

/**
 * TODO: DELETE this class after mantainance
 */
class AlboPretorioRecordsGetter extends RecordsGetterAbstract
{
    /**
     * @var AlboPretorioArticoliGetterWrapper
     */
    private $articoliWrapper;
    
    /**
     * @param array $input
     * @return AlboPretorioArticoliGetterWrapper
     */
    public function setArticoliInput(array $input)
    {
        $this->articoliWrapper = new AlboPretorioArticoliGetterWrapper(
            new AlboPretorioArticoliGetter($this->getEntityManager())
        );
        $this->articoliWrapper->setInput($input);
        $this->articoliWrapper->setupQueryBuilder();
        
        return $this->articoliWrapper;
    }

    /**
     * @return AlboPretorioArticoliGetterWrapper
     */
    public function setArticoliPaginator()
    {
        $this->assertAlboPretorioGetterWrapper();
        
        $arrayQuery = $this->articoliWrapper->setupQuery($this->getEntityManager());
        
        $this->articoliWrapper->setupPaginator($arrayQuery ? $arrayQuery : array());
        
        return $this->articoliWrapper;
    }
    
    /**
     * @param int|null $page
     * @return AlboPretorioArticoliGetterWrapper
     */
    public function setArticoliPaginatorCurrentPage($page = null)
    {
        $this->assertAlboPretorioGetterWrapper();
        
        $this->articoliWrapper->setupPaginatorCurrentPage($page);
        
        return $this->articoliWrapper;
    }

    /**
     * @param int $perpage
     * @return mixed
     */
    public function setArticoliPaginatorPerPage($perpage = null)
    {
        $this->assertAlboPretorioGetterWrapper();
        
        $this->articoliWrapper->setupPaginatorItemsPerPage($perpage);
        
        return $this->articoliWrapper;
    }

    /**
     * @return mixed
     */
    public function getPaginatorRecords()
    {
        $this->assertAlboPretorioGetterWrapper();
        
        return $this->articoliWrapper->getPaginator();
    }

        /**
         * @return null
         * @throws NullException
         */
        private function assertAlboPretorioGetterWrapper()
        {
            if (!$this->articoliWrapper) {
                throw new NullException('AlboPretorioGetterWrapper is not set. Use setArticoliInput before');
            }

            return null;
        }
    
    /**
     * @param array $input
     */
    public function setSezioni(array $input)
    {
        $wrapper = new AlboPretorioSezioniGetterWrapper(
            new AlboPretorioSezioniGetter($this->getEntityManager())
        );
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        $this->setRecords( $wrapper->getRecords() );
    }
    
    /**
     * @param array $input
     */
    public function setSettori(array $input)
    {
        $wrapper = new UsersSettoriGetterWrapper( new UsersSettoriGetter($this->getEntityManager()) );
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        $this->setRecords( $wrapper->getRecords() );
    }
    
    /**
     * Get distinct years for the articoli tables
     */
    public function getYears()
    {
        $this->articoliWrapper = new AlboPretorioArticoliGetterWrapper(
            new AlboPretorioArticoliGetter($this->getEntityManager())
        );
        $this->articoliWrapper->setInput( array(
                'fields'    => 'DISTINCT(alboArticoli.anno) AS anno',
                'orderBy'   => 'alboArticoli.anno'
            )
        );
        $this->articoliWrapper->setupQueryBuilder();

        $records = $this->articoliWrapper->getRecords();

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
