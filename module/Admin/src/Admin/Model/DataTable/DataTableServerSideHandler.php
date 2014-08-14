<?php

namespace Admin\Model\DataTable;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Admin\Model\AlboPretorio\AlboPretorioGetterWrapper;
use Admin\Model\AlboPretorio\AlboPretorioGetter;

/**
 * @author Andrea Fiori
 * @since  03 August 2014
 */
class DataTableServerSideHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);
        
        $input = array(
            'orderBy' => isset($param['get']['order_by']) ? $param['get']['order_by'] : null,
            'order' => isset($param['get']['order']) ? $param['get']['order'] : null,
        );
        
        $alboPretorioGetterWrapper = new AlboPretorioGetterWrapper( new AlboPretorioGetter($this->getInput('entityManager',1)) );
        $alboPretorioGetterWrapper->setInput(
                array_merge( $input, array(
                    'fields' => 'aa.anno, aa.titolo, aps.nome, aa.dataScadenza',
                    'limit' => 30
                    )
                )
        );
        $alboPretorioGetterWrapper->setupQueryBuilder();
        $alboPretorioGetterWrapper->setupPaginator( $alboPretorioGetterWrapper->setupQuery( $this->getInput('entityManager', 1) ) );
        $alboPretorioGetterWrapper->setupPaginatorCurrentPage(isset($param['route']['page']) ? $param['route']['page'] : null);
        $alboPretorioGetterWrapper->setupPaginatorItemsPerPage(isset($param['route']['perpage']) ? $param['route']['perpage'] : null);
        
        $records = $alboPretorioGetterWrapper->getPaginator();

        $this->setVariable('title', 'Albo pretorio');
        $this->setVariable('description', 'Elenco atti in archivio');
        $this->setVariable('columns', array('Num \ Anno', 'Titolo', 'Settore', 'Scadenza', 'Data attivazione', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;' ) );
        $this->setVariable('tablesetter', 'albo-pretorio');
        $this->setVariable('paginator', $records);
        $this->setVariable('route', 'admin/datatable');
        $this->setTemplate('datatable/datatable_server_side.phtml');
        
        return $this->getOutput();
    }
}
