<?php

namespace Application\Model\AttiConcessione;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\AttiConcessione\AttiConcessioneGetter;
use Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  23 January 2015
 */
class AttiConcessioneFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);
        $config = $this->getInput('configurations', 1);
        
        $paginatorRecords = $this->getAttiRecords(
            array(
                'orderBy' => 'aa.id DESC',
            ),
            isset($param['route']['page']) ? $param['route']['page'] : ''
        );

        $this->setVariables(array(
                'form'                       => '',
                'paginator'                  => $paginatorRecords,
                'paginator_total_item_count' => $paginatorRecords->getTotalItemCount(),
                'basiclayout'                => isset($config['atti_concessione_basiclayout']) ? $config['atti_concessione_basiclayout'] : null
            )
        );
        
        $this->setTemplate('atti-concessione/atti-concessione.phtml');

        return $this->getOutput();
    }

        /**
         * 
         * @param array $input
         * @param type $page
         * @return AttiConcessioneGetterWrapper
         */
        private function getAttiRecords(array $input, $page = 0)
        {
            $wrapper = new AttiConcessioneGetterWrapper( new AttiConcessioneGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            $wrapper->setupPaginator( $wrapper->setupQuery( $this->getInput('entityManager', 1) ));
            $wrapper->setupPaginatorCurrentPage($page);

            return $wrapper->getPaginator();
        }
}
