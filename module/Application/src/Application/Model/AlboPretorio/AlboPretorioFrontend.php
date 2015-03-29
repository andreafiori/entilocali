<?php

namespace Application\Model\AlboPretorio;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\AlboPretorio\AlboPretorioRecordsGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class AlboPretorioFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    /**
     * @var AlboPretorioRecordsGetter
     */
    private $alboPretorioRecordsGetter;
    
    public function setupRecord()
    {
        $this->alboPretorioRecordsGetter = new AlboPretorioRecordsGetter($this->getInput());
        
        $param = $this->getInput('param', 1);
        $paginatorRecords = $this->getAlboPretorioRecords(
            array(
                'annullato'  => 0,
                'pubblicare' => 1,
                'attivo'     => 1,
            ),
            isset($param['route']['page']) ? $param['route']['page'] : ''
        );

        $this->setRecords($paginatorRecords);
        $this->setTemplate('albo-pretorio/albo-pretorio.phtml');
        $this->setVariables(array(
            'form'      => $this->getFormSearch(),
            'paginator' => $paginatorRecords
        ));
    }
    
        /**
         * @return AlboPretorioFormSearch
         */
        private function getFormSearch()
        {
            $alboPretorioFormSearch = new AlboPretorioFormSearch();
            $alboPretorioFormSearch->addSezioni( $this->getSezioni(array()) );
            $alboPretorioFormSearch->addSettori( $this->getSettori(array('fields' => 'DISTINCT(u.settore) AS settore, u.id', 'groupBy'=>'settore')) );
            $alboPretorioFormSearch->addCheckExpired();
            $alboPretorioFormSearch->addCsrf();
            $alboPretorioFormSearch->addFrontendSubmitButton();

            return $alboPretorioFormSearch;
        }
        
        /**
         * @param array $input
         * @return array|null
         */
        private function getSezioni(array $input)
        {
            $this->alboPretorioRecordsGetter->setSezioni($input);
            
            return $this->alboPretorioRecordsGetter->formatSezioniForFormSelect('id', 'nome');
        }
        
        /**
         * Get albo settori from users data
         * 
         * @return array|null
         */
        private function getSettori(array $input)
        {
            $this->alboPretorioRecordsGetter->setSettori($input);

            return $this->alboPretorioRecordsGetter->formatSezioniForFormSelect('id', 'settore');
        }
        
        /**
         * @param array $input
         * @param int $page
         * @return array|null
         */
        private function getAlboPretorioRecords(array $input, $page)
        {
            $wrapper = new AlboPretorioArticoliGetterWrapper( new AlboPretorioArticoliGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery( $this->getInput('entityManager', 1) ));
            $wrapper->setupPaginatorCurrentPage($page);
            
            return $wrapper->getPaginator();
        }
}

