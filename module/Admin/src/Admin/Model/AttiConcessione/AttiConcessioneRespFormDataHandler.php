<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetter;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetterWrapper;

class AttiConcessioneRespFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        
        if (isset($param['route']['option'])) {
            $wrapper = new AttiConcessioneSezioniGetterWrapper( new AttiConcessioneSezioniGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('id' => $param['route']['option'], 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();
        }
        
        $form = new AttiConcessioneRespProcForm();
        
        $this->setVariable('formTitle',         'Nuovo responsabile');
        $this->setVariable('formDescription',   'Inserisci nuovo articolo. &Egrave; consigliabile inserire dei testi brevi sul tema trattato, possibilmente in minuscolo');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        '');
        $this->setVariable('formBreadCrumbCategory', 'Amministrazione Trasparente');
        $this->setVariable('CKEditorField', array('sottotitolo','testo'));
    }
}