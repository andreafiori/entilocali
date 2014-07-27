<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Admin\Model\StatoCivile\StatoCivileSezioniGetter;
use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;

/**
 * TODO: check if module is active, check ACL, check sezioni, optimize db, check migration
 * 
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileFormDataHandler extends FormDataAbstract
{
    protected $param;
    protected $entityManager;


    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
                
        $this->param = $this->getInput('param', 1);
        $this->entityManager = $this->getInput('entityManager', 1);
        
        $this->setForm( new StatoCivileForm() );
        
        if ( isset($this->param['route']['option']) ) {
            $records = $this->getArticoloRecord($this->param['route']['option']);
        }
        
        if ( !empty($records) ) {
            $formTitle = $records['titolo'];
            
            $this->getForm()->setData( $records );
        } else {
            
            $formTitle = 'Nuovo atto stato civile';
        }
        
        $this->setVariable('formTitle',         $formTitle);
        $this->setVariable('formDescription',   '&Egrave; consigliabile inserire testi brevi sul tema trattato, possibilmente in minuscolo.');
        $this->setVariable('form',              $this->getForm());
        $this->setVariable('formAction',        '');
        $this->setVariable('formBreadCrumbCategory', 'Stato civile');
        $this->setVariable('formBreadCrumbCategoryLink', $this->getInput('baseUrl',1).'datatable/stato-civile/');
    }
    
    /**
     * @param number $id
     * @return array or null
     */
    private function getArticoloRecord($id)
    {
        if (!is_numeric($id)) {
            return false;
        }
        
        $statoCivileGetterWrapper = new StatoCivileGetterWrapper( new StatoCivileGetter($this->entityManager) );
        $statoCivileGetterWrapper->setInput( array('id' => $id) );
        $statoCivileGetterWrapper->setupQueryBuilder();

        $records = $statoCivileGetterWrapper->getRecords();
        if ($records) {
            return $records[0];
        }
        
        return false;
    }
}