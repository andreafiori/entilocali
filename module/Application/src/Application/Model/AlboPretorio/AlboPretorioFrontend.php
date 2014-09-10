<?php

namespace Application\Model\AlboPretorio;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\AlboPretorio\RecordsGetter;
use Admin\Model\AlboPretorio\ArticoliGetter;
use Admin\Model\AlboPretorio\ArticoliGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class AlboPretorioFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    /** @var Admin\Model\AlboPretorio\AlboPretorioRecordsGetter **/
    private $alboPretorioRecordsGetter;
    
    public function setupRecord()
    {
        $this->alboPretorioRecordsGetter = new RecordsGetter($this->getInput());
        
        $param = $this->getInput('param', 1);
        $records = $this->getAlboPretorioRecords(array(), isset($param['route']['page']) ? $param['route']['page'] : '');
        
        $this->setVariable('form',      $this->getFormSearch() );
        $this->setVariable('paginator', $records);
        $this->setRecords($records);
        $this->setTemplate('albo-pretorio/albo-pretorio.phtml');
    }
    
        /**
         * @return \Application\Model\AlboPretorio\AlboPretorioFormSearch
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
         * @return type
         */
        private function getSezioni(array $input)
        {
            $this->alboPretorioRecordsGetter->setSezioni($input);
            
            return $this->alboPretorioRecordsGetter->formatSezioniForFormSelect('id', 'nome');
        }
        
        /**
         * Get albo settori from users data
         * 
         * @return type
         */
        private function getSettori(array $input)
        {
            $this->alboPretorioRecordsGetter->setSettori($input);

            return $this->alboPretorioRecordsGetter->formatSezioniForFormSelect('id', 'settore');
        }

        private function getAlboPretorioRecords($input, $page)
        {
            $alboPretorioGetterWrapper = new ArticoliGetterWrapper( new ArticoliGetter($this->getInput('entityManager',1)) );
            $alboPretorioGetterWrapper->setInput($input);
            $alboPretorioGetterWrapper->setupQueryBuilder();
            $alboPretorioGetterWrapper->setupPaginator($alboPretorioGetterWrapper->setupQuery( $this->getInput('entityManager', 1) ));
            $alboPretorioGetterWrapper->setupPaginatorCurrentPage($page);
            
            return $alboPretorioGetterWrapper->getPaginator();
        }
}

