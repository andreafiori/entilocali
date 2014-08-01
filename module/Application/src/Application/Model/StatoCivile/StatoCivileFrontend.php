<?php

namespace Application\Model\StatoCivile;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Model\StatoCivile\StatoCivileFormSearch;
use Admin\Model\StatoCivile\StatoCivileRecordsGetter;

/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class StatoCivileFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    private $param;
    
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);
        
        $sezioni = $this->getSezioni( array() );
        
        /* set form */
        $form = new StatoCivileFormSearch();
        $form->addSezioni($sezioni);
        $form->addMesi();
        $form->addAnni();
        $form->addSubmitButton();
        
        /* Check post */
        if ( isset($param['post']) ) {
            $rawPosts = $param['post'];
            $arraySearch = array( 'textsearch' => $rawPosts['testo'], 'anno' => $rawPosts['anno'], 'mese' => $rawPosts['mese'], 
                'sezione' => $rawPosts['sezione']
            );
            
            /* TODO: save form data on session */
            
            $form->setData($rawPosts);
        }
        
        /* set paginated records */
        $paginatorRecords = $this->getPaginatorRecords(isset($param['route']['page']) ? $param['route']['page'] : null);
        
        $this->setVariable('paginator', $paginatorRecords);
        $this->setVariable('form', $form);
        $this->setRecords($paginatorRecords);
        $this->setTemplate('stato-civile/stato-civile.phtml');
        
        return $this->getOutput();
    }
        /**
         * @param type $page
         * @return type
         */
        private function getPaginatorRecords($page = null)
        {
            $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager', 1)) );
            $statoCivileGetterWrapper->setInput( array('orderBy' => 'sca.data DESC') );
            $statoCivileGetterWrapper->setupQueryBuilder();
            $statoCivileGetterWrapper->setupQuery($this->getInput('entityManager', 1));

            return $statoCivileGetterWrapper->setupPaginator($page);
        }
        
        /**
         * @param array $input
         * @return type
         */
        private function getSezioni(array $input)
        {
            $statoCivileRecordsGetter = new StatoCivileRecordsGetter($this->getInput());
            $statoCivileRecordsGetter->setSezioni($input);
            
            return $statoCivileRecordsGetter->formatSezioniForFormSelect('id', 'nome');
        }
}
