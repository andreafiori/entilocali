<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\StatoCivile\StatoCivileRecordsGetter;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileFormDataHandler extends FormDataAbstract
{
    protected $param, $entityManager;
    private $recordsGetter;

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $this->param = $this->getInput('param', 1);
        $this->entityManager = $this->getInput('entityManager', 1);
        $this->recordsGetter = new StatoCivileRecordsGetter($this->getInput());
        $this->setForm( new StatoCivileForm() );
        $this->getForm()->addSezioni( $this->getSezioni() );
        $this->getForm()->addDates();

        if ( isset($this->param['route']['option']) ) {
            $records = $this->getArticoloRecord($this->param['route']['option']);
        }
        
        if ( !empty($records) ) {
            $formTitle = $records['titolo'];
            $this->getForm()->setData( $records );
        } else {
            $formTitle = 'Nuovo atto stato civile';
        }

        $this->setVariables(array(
            'formTitle'                     => $formTitle,
            'formDescription'               => '&Egrave; consigliabile inserire testi brevi sul tema trattato, possibilmente in minuscolo',
            'form'                          => $this->getForm(),
            'formAction'                    =>  '',
            'formBreadCrumbCategory'        => 'Stato civile',
            'formBreadCrumbCategoryLink'    => $this->getInput('baseUrl',1).'datatable/stato-civile/',
            )
        );
    }
    
        /**
         * @param number $id
         * @return array|null
         */
        private function getArticoloRecord($id)
        {
            if (!is_numeric($id)) {
                return false;
            }
 
            $this->recordsGetter->setFirstRow();
            $this->recordsGetter->setArticoli( array('id' => $id) );
            
            return $this->recordsGetter->returnRecordset();
        }
        
        /**
         * @return array|null
         */
        private function getSezioni()
        {
            $this->recordsGetter = new StatoCivileRecordsGetter($this->getInput());
            $this->recordsGetter->setSezioni( array() );
 
            return $this->recordsGetter->formatSezioniForFormSelect('id','nome');
        }
}