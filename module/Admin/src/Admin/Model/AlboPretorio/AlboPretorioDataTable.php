<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\DataTable\DataTableAbstract;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class AlboPretorioDataTable extends DataTableAbstract implements DataTableInterface
{
    private $alboPretorioRecordsGetter;

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $paginatorRecords = $this->setupArticoliPaginatorRecords();

        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );

        $this->setVariable('tablesetter', 'albo-pretorio');
        $this->setVariable('paginator', $paginatorRecords);
        $this->setVariable('formSearch', $this->setupFormSearchAndExport(new AlboPretorioSearchFilterForm()));
        $this->setVariable('formExport', $this->setupFormSearchAndExport(new AlboPretorioExportForm(), 'export', 'Esporta'));
        
        $this->setTitle('Albo pretorio');
        $this->setDescription('Elenco atti albo pretorio');
        $this->setColumns(array( 
                array('label' => 'Num \ Anno','width' => '10%'),
                array('label' => 'Titolo','width' => '44%'), 
                'Settore', 
                'Scadenza', 
                'Data attivazione', 
                '&nbsp;', 
                '&nbsp;', 
                '&nbsp;', 
                '&nbsp;'
            )
        );
    }
    
        /**
         * @return type
         */
        private function setupArticoliPaginatorRecords()
        {
            $param = $this->getParam();

            $this->alboPretorioRecordsGetter = new AlboPretorioRecordsGetter( $this->getInput() );
            $this->alboPretorioRecordsGetter->setArticoliInput( array() );
            $this->alboPretorioRecordsGetter->setArticoliPaginator();
            $this->alboPretorioRecordsGetter->setArticoliPaginatorCurrentPage(isset($param['route']['page']) ? $param['route']['page'] : null);
            $this->alboPretorioRecordsGetter->setArticoliPaginatorPerPage(isset($param['route']['perpage']) ? $param['route']['perpage'] : null);

            return $this->alboPretorioRecordsGetter->getPaginatorRecords();
        }

    /**
     * Overwrite default template
     * 
     * @return type
     */
    public function getTemplate()
    {
        if ( $this->getRecords() ) {
            return $this->setTemplate('datatable/datatable_albo.phtml');
        } else {
            return parent::getTemplate();
        }
    }
    
        /**
         * 
         * @param \AlboPretorioFormAbstract $form
         * @param string $labelName
         * @param string $labelValue
         * @return \Zend\Form\Form
         */
        private function setupFormSearchAndExport(AlboPretorioFormAbstract $form, $labelName = null, $labelValue = null)
        {
            $form->addMonths();
            $form->addYears( $this->alboPretorioRecordsGetter->getYears() );
            $form->addSezioni( $this->getSezioni( array('orderBy' => 'aps.nome') ) );
            $form->addSettori( $this->getSettori( array('fields' => 'DISTINCT(u.settore) AS settore, u.id', 'groupBy'=>'settore') ));
            $form->addOrderBy();
            $form->addSubmitButton($labelName, $labelValue);
            
            return $form;
        }
 
        /**
         * @param array $input
         * @return type
         */
        private function getSezioni(array $input)
        {
            $this->alboPretorioRecordsGetter->setSezioni($input);

            return $this->alboPretorioRecordsGetter->formatSezioniForFormSelect('id','nome');
        }
        
        /**
         * @param array $input
         * @return type
         */
        private function getSettori(array $input)
        {
            $this->alboPretorioRecordsGetter->setSettori($input);

            return $this->alboPretorioRecordsGetter->formatSezioniForFormSelect('id','settore');
        }
        
        /**
         * @param array $records
         * @return array
         */
        private function getFormattedDataTableRecords($records)
        {
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        $row['numeroAtto']." / ".$row['anno'],
                        $row['titolo'],
                        $row['nome'],
                        $row['dataScadenza'],
                        $row['dataAttivazione'],
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/albo-pretorio/'.$row['id'],
                            'tooltip'   => 1,
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'relatapdfButton',
                            'href'      => '#',
                            'tooltip'   => 1,
                        ),
                        array(
                            'type'      => 'attachButton',
                            'href'      => '#',
                            'tooltip'   => 1
                        ),
                        array(
                            'type'      => 'enteterzoButton',
                            'href'      => '#',
                            'tooltip'   => 1,
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}
