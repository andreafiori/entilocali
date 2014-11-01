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
    protected $param;

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->param = $this->getParam();
        
        $paginatorRecords = $this->setupRecordsGetter( new AlboPretorioRecordsGetter($this->getInput()), $this->setupArticoliInput());
        
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
                array('label' => 'Num \ Anno', 'width' => '10%'),
                array('label' => 'Titolo', 'width' => '44%'),
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
        
        $this->setTemplate('datatable/datatable_albo_pretorio.phtml');
    }

        /**
         * @return type
         */
        private function setupArticoliInput()
        {
            $articoliInput = array();
            
            $sessionPost = new SessionContainer();
            
            if ( isset($this->param['post']) ) {
                $articoliInput = array(
                    'anno'      => isset($this->param['post']['anno']) ? $this->param['post']['anno'] : null,
                    'search'    => isset($this->param['post']['search']) ? $this->param['post']['search'] : null,
                    'orderBy'   => isset($this->param['post']['orderby']) ? $this->param['post']['orderby'] : null
                );
                $sessionPost->offsetSet(self::sessionPostKey, $articoliInput);
            } else {
                $postFromSession = $sessionPost->offsetGet(self::sessionPostKey);
                if ($postFromSession) {
                    $articoliInput = $postFromSession;
                }
            }

            return $articoliInput;
        }
        
        /**
         * 
         * @param \Admin\Model\AlboPretorio\AlboPretorioRecordsGetter $recordsGetter
         * @param array $input
         * @return Paginator
         */
        private function setupRecordsGetter(AlboPretorioRecordsGetter $recordsGetter, array $input)
        {
            $this->recordsGetter = $recordsGetter;
            $this->recordsGetter->setArticoliInput($input);
            $this->recordsGetter->setArticoliPaginator();
            $this->recordsGetter->setArticoliPaginatorCurrentPage(isset($this->param['route']['page']) ? $this->param['route']['page'] : null);
            $this->recordsGetter->setArticoliPaginatorPerPage(isset($this->param['route']['perpage']) ? $this->param['route']['perpage'] : null);

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
         * @return array|null
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
                            'title'     => 'Modifica articolo'
                        ),
                        array(
                            'type'      => 'relatapdfButton',
                            'href'      => '#',
                        ),
                        array(
                            'type'      => 'attachButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/attachments/albo-pretorio/'.$row['id'],
                        ),
                        array(
                            'type'      => 'enteterzoButton',
                            'href'      => $this->getInput('baseUrl',1).'invio-ente-terzo/albo-pretorio/'.$row['id'],
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}
