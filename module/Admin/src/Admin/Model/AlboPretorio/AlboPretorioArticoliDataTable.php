<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\DataTable\DataTableAbstract;
use Zend\Session\Container as SessionContainer;

/**
 * @author Andrea Fiori
 * @since  18 May 2014
 */
class AlboPretorioArticoliDataTable extends DataTableAbstract implements DataTableInterface
{
    /** session key where it stores post from form **/
    const sessionPostKey = 'alboPretorioDataTable';
    
    private $recordsGetter;

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $paginatorRecords = $this->setupArticoliPaginatorRecords();
        $this->setVariables(
            array(
                'tablesetter' => 'albo-pretorio',
                'paginator'   => $paginatorRecords,
                'formSearch'  => $this->setupFormSearchAndExport(new AlboPretorioArticoliSearchFilterForm()),
                'formExport'  => $this->setupFormSearchAndExport(new AlboPretorioArticoliSearchFilterForm(), 'export', 'Esporta'),
            )
        );
        $this->setTitle('Albo pretorio');
        $this->setDescription('Elenco atti albo pretorio. Effettuando una ricerca, le informazioni vengono memorizzate.');
        $this->setColumns(
            array(
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
        $this->setRecords( $this->getFormattedDataTableRecords($paginatorRecords) );
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
         * @return type
         */
        private function setupArticoliPaginatorRecords()
        {
            $articoliInput = array();
            $sessionPost = new SessionContainer();
            
            $param = $this->getParam();
            if ( isset($param['post']) ) {
                $articoliInput = array(
                    'anno'      => isset($param['post']['anno']) ? $param['post']['anno'] : null,
                    'search'    => isset($param['post']['search']) ? $param['post']['search'] : null,
                    'orderBy'   => isset($param['post']['orderby']) ? $param['post']['orderby'] : null
                );
                $sessionPost->offsetSet(self::sessionPostKey, $articoliInput);
            } else {
                $postFromSession = $sessionPost->offsetGet(self::sessionPostKey);
                if ($postFromSession) {
                    $articoliInput = $postFromSession;
                }
            }

            $this->recordsGetter = new AlboPretorioRecordsGetter( $this->getInput() );
            $this->recordsGetter->setArticoliInput($articoliInput);
            $this->recordsGetter->setArticoliPaginator();
            $this->recordsGetter->setArticoliPaginatorCurrentPage(isset($param['route']['page']) ? $param['route']['page'] : null);
            $this->recordsGetter->setArticoliPaginatorPerPage(isset($param['route']['perpage']) ? $param['route']['perpage'] : null);

            return $this->recordsGetter->getPaginatorRecords();
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
            $form->addYears( $this->recordsGetter->getYears() );
            $form->addSezioni( $this->getSezioni( array('orderBy' => 'aps.nome') ) );
            $form->addSettori( $this->getSettori( array('fields' => 'DISTINCT(u.settore) AS settore, u.id', 'groupBy'=>'settore') ));
            $form->addOrderBy();
            $form->addSubmitButton($labelName, $labelValue);
            
            $paramPost = $this->getParam('post');
            if ( isset($paramPost) ) {
                $form->setData($paramPost);
            }
            
            return $form;
        }

        /**
         * @param array $input
         * @return type
         */
        private function getSezioni(array $input)
        {
            $this->recordsGetter->setSezioni($input);

            return $this->recordsGetter->formatSezioniForFormSelect('id','nome');
        }
        
        /**
         * @param array $input
         * @return type
         */
        private function getSettori(array $input)
        {
            $this->recordsGetter->setSettori($input);

            return $this->recordsGetter->formatSezioniForFormSelect('id','settore');
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
                            'href'      => $this->getInput('baseUrl',1).'attachments/albo-pretorio/'.$row['id'],
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
