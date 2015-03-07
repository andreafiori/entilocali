<?php

namespace Application\Model\ContrattiPubblici;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use Admin\Model\ContrattiPubblici\Settori\SettoriGetter;
use Admin\Model\ContrattiPubblici\Settori\SettoriGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  07 May 2014
 */
class ContrattiPubbliciFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);
        $config = $this->getInput('configurations', 1);
        
        $paginatorRecords = $this->getContrattiRecords(
            array(
                'annullato'  => 0,
                'pubblicare' => 1,
                'attivo'     => 1,
            ),
            isset($param['route']['page']) ? $param['route']['page'] : ''
        );
        
        $this->setRecords($paginatorRecords);
        $this->setTemplate('contratti-pubblici/contratti-pubblici.phtml');
        $this->setVariables(array(
            'form'                       => $this->getFormSearch(),
            'paginator'                  => $paginatorRecords,
            'paginator_total_item_count' => $paginatorRecords->getTotalItemCount(),
            'basiclayout'                => isset($config['contratti_pubblici_basiclayout']) ? $config['contratti_pubblici_basiclayout'] : null
        ));
    }
    
        /**
         * @return \Application\Model\ContrattiPubblici\ContrattiPubbliciFormSearch
         */
        private function getFormSearch()
        {
            $wrapperContratti = $this->getContrattiWrapper(array('fields' => 'DISTINCT cc.anno AS anno', 'orderBy' => 'cc.anno'));
            $years = $wrapperContratti->getRecords();
            
            $yearsArray = array();
            foreach($years as $year) {
                $yearsArray[] = $year['anno'];
            }
            
            $settoriRecords = $this->getSettori(array(
                
            ));
            
            $settori = array();
            foreach($settoriRecords as $settore) {
                $settori[$settore['id']] = $settore['nome'].' '.$settore['responsabile'];
            }
            
            $form = new ContrattiPubbliciFormSearch();
            $form->addYears($yearsArray);
            $form->addMainFormElements();
            $form->addSettori($settori);
            $form->addSubmit();

            return $form;
        }
        
        /**
         * 
         * @param array $input
         * @param int $page
         * @return array
         */
        private function getSettori(array $input)
        {
            $wrapper = new SettoriGetterWrapper( new SettoriGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            
            return $wrapper->getRecords();
        }

        /**
         * @param array $input
         * @param int   $page
         * @return Paginator
         */
        private function getContrattiRecords(array $input, $page = 0)
        {
            $wrapper = $this->getContrattiWrapper($input);
            $wrapper->setupPaginator( $wrapper->setupQuery( $this->getInput('entityManager', 1) ));
            $wrapper->setupPaginatorCurrentPage($page);
            
            return $wrapper->getPaginator();
        }
        
        /**
         * @param array $input
         */
        private function getContrattiWrapper(array $input)
        {
            $wrapper = new ContrattiPubbliciGetterWrapper( new ContrattiPubbliciGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            
            return $wrapper;
        }
}