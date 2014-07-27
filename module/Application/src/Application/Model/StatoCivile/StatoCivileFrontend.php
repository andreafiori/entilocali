<?php

namespace Application\Model\StatoCivile;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Model\StatoCivile\StatoCivileFormSearch;

/**
 * @author Andrea Fiori
 * @since  08 May 2014
 */
class StatoCivileFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $paginatorRecords = $this->getPaginatorRecords();
        
        $this->setVariable('form', $this->getFormSearch());
        $this->setVariable('paginator', $paginatorRecords);
        $this->setRecords($paginatorRecords);
        $this->setTemplate('stato-civile/stato-civile.phtml');
        
        return $this->getOutput();
    }
    
        private function getFormSearch()
        {
            $form = new StatoCivileFormSearch();
            
            $form->addSubmitButton();
            
            return $form;
        }

        private function getPaginatorRecords()
        {
            $param = $this->getInput('param', 1);

            $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->getInput('entityManager',1)) );
            $statoCivileGetterWrapper->setupQueryBuilder();
            $statoCivileGetterWrapper->setupQuery($this->getInput('entityManager', 1));

            return $statoCivileGetterWrapper->setupPaginator(isset($param['route']['page']) ? $param['route']['page'] : '');
        }
}
