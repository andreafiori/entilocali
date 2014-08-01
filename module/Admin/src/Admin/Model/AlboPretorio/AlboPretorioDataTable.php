<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\AlboPretorio\AlboPretorioRecordsGetter;
use Admin\Model\DataTable\DataTableAbstract;
use Admin\Model\AlboPretorio\AlboPretorioSearchFilterForm;

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
        
        $this->alboPretorioRecordsGetter = new AlboPretorioRecordsGetter( $this->getInput() );
        
        $records = $this->getAlboPretorioRecords(array());
        $this->setRecords( $this->getFormattedDataTableRecords($records) );
        
        $alboPretorioSearchFilterForm = new AlboPretorioSearchFilterForm();
        $alboPretorioSearchFilterForm->addMonths();
        $alboPretorioSearchFilterForm->addYears( $this->alboPretorioRecordsGetter->getYears($records) );
        $alboPretorioSearchFilterForm->addSezioni( $this->getSezioni( array() ) );
        $alboPretorioSearchFilterForm->addSettori( $this->getSettori( array('fields' => 'DISTINCT(u.settore) AS settore, u.id', 'groupBy'=>'settore') ));
        $alboPretorioSearchFilterForm->addSubmitButton();
        
        $this->setTitle('Albo pretorio');
        $this->setDescription('Elenco atti albo pretorio');
        $this->setColumns(array('Num \ Anno', 'Titolo', 'Settore', 'Scadenza', 'Data attivazione', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;' ));
        
        $this->setVariable('formSearch', $alboPretorioSearchFilterForm);
    }

        /**
         * @return array
         */
        private function getAlboPretorioRecords(array $input)
        {
            $this->alboPretorioRecordsGetter->setArticoli($input);

            return $this->alboPretorioRecordsGetter->returnRecordset();
        }

        private function getFormattedDataTableRecords($records)
        {
            if (!is_array($records)) {
                return false;
            }
            
            $arrayToReturn = array();
            if ($records) {
                foreach($records as $record) {
                    $arrayToReturn[] = array(
                        $record['numeroAtto']." / ".$record['anno'],
                        $record['titolo'],
                        $record['nome'],
                        $this->convertDateTimeToString($record['dataScadenza']),
                        $this->convertDateTimeToString($record['dataAttivazione']),
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/albo-pretorio/'.$record['id'],
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

        /**
         * @param array $input
         * @return type
         */
        private function getSezioni(array $input)
        {
            $alboPretorioRecordsGetter = new AlboPretorioRecordsGetter( $this->getInput() );
            $alboPretorioRecordsGetter->setSezioni($input);

            return $alboPretorioRecordsGetter->formatSezioniForFormSelect('id','nome');
        }
        
        /**
         * @param array $input
         * @return type
         */
        private function getSettori(array $input)
        {
            $alboPretorioRecordsGetter = new AlboPretorioRecordsGetter( $this->getInput() );
            $alboPretorioRecordsGetter->setSettori($input);

            return $alboPretorioRecordsGetter->formatSezioniForFormSelect('id','settore');
        }

    /**
     * Overwrite default template
     * 
     * @return type
     */
    public function getTemplate()
    {
        if ($this->getRecords()) {
            return $this->setTemplate('datatable/datatable_albo.phtml');
        } else {
            return parent::getTemplate();
        }
    }
}
