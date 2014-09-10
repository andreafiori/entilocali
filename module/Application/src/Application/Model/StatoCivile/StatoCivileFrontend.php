<?php

namespace Application\Model\StatoCivile;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Model\StatoCivile\StatoCivileFormSearch;
use Admin\Model\StatoCivile\StatoCivileRecordsGetter;
// use Zend\Session\Container as SessionContainer;

/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class StatoCivileFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $form = new StatoCivileFormSearch();
        $form->addSezioni( $this->getSezioni( array() ) );
        $form->addMesi();
        $form->addAnni();
        $form->addSubmitButton();
        
        $param = $this->getInput('param', 1);
        if ( isset($param['post']) ) {
            $form->setData($param['post']);
            $arraySearch = array(
                'textSearch' => $param['post']['testo'],
                'anno' => $param['post']['anno'],
                'mese' => $param['post']['mese'],
                'sezione' => $param['post']['sezione']
            );
            
            $statoCivileRecordsGetter = new StatoCivileRecordsGetter($this->getInput());
            $statoCivileRecordsGetter->setArticoli($arraySearch);
            $statoCivileRecordsGetter->returnRecordset();
        } else {
            $arraySearch = array();
        }

        $paginatorRecords = $this->getPaginatorRecords($arraySearch, isset($param['route']['page']) ? $param['route']['page'] : null);
        
        $this->setVariable('paginator', $paginatorRecords);
        $this->setVariable('form', $form);
        $this->setRecords($paginatorRecords);
        $this->setTemplate('stato-civile/stato-civile.phtml');
        
        return $this->getOutput();
    }
    
        /**
         * @param array $input
         * @param type $page
         * @return type
         */
        private function getPaginatorRecords(array $input, $page = null)
        {
            $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager', 1)) );
            $statoCivileGetterWrapper->setInput( array_merge($input, array('orderBy' => 'sca.data DESC')) );
            $statoCivileGetterWrapper->setupQueryBuilder();
            
            return $statoCivileGetterWrapper->setupPaginator( $statoCivileGetterWrapper->setupQuery($this->getInput('entityManager', 1)) );
        }
        
        /**
         * @param array $queryInput
         * @return type
         */
        private function getSezioni(array $queryInput)
        {
            $statoCivileRecordsGetter = new StatoCivileRecordsGetter($this->getInput());
            $statoCivileRecordsGetter->setSezioni($queryInput);
            
            return $statoCivileRecordsGetter->formatSezioniForFormSelect('id', 'nome');
        }
}
