<?php

namespace Application\Model\AlboPretorio;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Model\AlboPretorio\AlboPretorioFormSearch;

use Admin\Model\AlboPretorio\AlboPretorioRecordsGetter;

use Admin\Model\AlboPretorio\AlboPretorioGetter;
use Admin\Model\AlboPretorio\AlboPretorioGetterWrapper;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Admin\Model\Users\UsersSettoriGetter;
use Admin\Model\Users\UsersSettoriGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class AlboPretorioFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    private $alboPretorioRecordsGetter;
    
    public function setupRecord()
    {
        $this->alboPretorioRecordsGetter = new AlboPretorioRecordsGetter($this->getInput());
        
        $param = $this->getInput('param', 1);
        $records = $this->getAlboPretorioRecords(array(), isset($param['route']['page']) ? $param['route']['page'] : '');
        
        $this->setVariable('form',      $this->getFormSearch() );
        $this->setVariable('paginator', $records);
        $this->setRecords($records);
        $this->setTemplate('albo-pretorio/albo-pretorio.phtml');
    }

        private function getFormSearch()
        {
            $alboPretorioFormSearch = new AlboPretorioFormSearch();
            $alboPretorioFormSearch->addSezioni( $this->getSezioni(array()) );
            $alboPretorioFormSearch->addSettori( $this->getSettori(array('fields' => 'DISTINCT(u.settore) AS settore, u.id', 'groupBy'=>'settore')) );
            $alboPretorioFormSearch->addCheckExpired();
            $alboPretorioFormSearch->addSubmitButton();

            return $alboPretorioFormSearch;
        }
        
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
            $alboPretorioGetterWrapper = new AlboPretorioGetterWrapper( new AlboPretorioGetter($this->getInput('entityManager',1)) );
            $alboPretorioGetterWrapper->setInput($input);
            $alboPretorioGetterWrapper->setupQueryBuilder();
            $alboPretorioGetterWrapper->setupQuery( $this->getInput('entityManager', 1) );

            return $alboPretorioGetterWrapper->setupPaginator($page);
        }   
}

