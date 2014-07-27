<?php

namespace Application\Model\AlboPretorio;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Model\AlboPretorio\AlboPretorioFormSearch;
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
    public function setupRecord()
    {
        $records = $this->getAlboPretorioRecords();
        
        $this->setVariable('form',      $this->getFormSearch() );
        $this->setVariable('paginator', $records);
        $this->setRecords($records);
        $this->setTemplate('albo-pretorio/albo-pretorio.phtml');
    }

        private function getFormSearch()
        {
            $alboPretorioFormSearch = new AlboPretorioFormSearch();
            $alboPretorioFormSearch->addSezioni( $this->getSezioni() );
            $alboPretorioFormSearch->addSettori( $this->getSettori() );
            $alboPretorioFormSearch->addCheckExpired();
            $alboPretorioFormSearch->addSubmitButton();

            return $alboPretorioFormSearch;
        }
        
        private function getSezioni()
        {
            $alboPretorioSezioniGetterWrapper = new AlboPretorioSezioniGetterWrapper( new AlboPretorioSezioniGetter($this->getInput('entityManager',1)) );
            $alboPretorioSezioniGetterWrapper->setInput( array() );
            $alboPretorioSezioniGetterWrapper->setupQueryBuilder();
            
            $records = $alboPretorioSezioniGetterWrapper->getRecords();
            
            if ($records) {
                $arrayToReturn = array();
                foreach($records as $record) {
                    $arrayToReturn[$record['id']] = $record['nome'];
                }
            }
            
            return $arrayToReturn;
        }
        
        /**
         * get albo settori from users data
         * 
         * @return type
         */
        public function getSettori()
        {
            $usersSettoriGetterWrapper = new UsersSettoriGetterWrapper( new UsersSettoriGetter($this->getInput('entityManager', 1)) );
            $usersSettoriGetterWrapper->setInput( array() );
            $usersSettoriGetterWrapper->setupQueryBuilder();
            
            $records = $usersSettoriGetterWrapper->getRecords();
            
            if ($records) {
                $arrayToReturn = array();
                foreach($records as $record) {
                    $arrayToReturn[$record['id']] = $record['name'];
                }
            }
            
            return $arrayToReturn;
        }

        private function getAlboPretorioRecords()
        {
            $param = $this->getInput('param', 1);

            $alboPretorioGetterWrapper = new AlboPretorioGetterWrapper( new AlboPretorioGetter($this->getInput('entityManager',1)) );
            $alboPretorioGetterWrapper->setInput( array() );
            $alboPretorioGetterWrapper->setupQueryBuilder();
            $alboPretorioGetterWrapper->setupQuery( $this->getInput('entityManager',1) );

            return $alboPretorioGetterWrapper->setupPaginator(isset($param['route']['page']) ? $param['route']['page'] : '');
        }   
}
