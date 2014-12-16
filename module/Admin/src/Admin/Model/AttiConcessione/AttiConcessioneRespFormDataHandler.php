<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\FormDataAbstract;

class AttiConcessioneRespFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $form = new AttiConcessioneRespProcForm();
        
        $this->setVariable('formTitle',         'Nuovo responsabile');
        $this->setVariable('formDescription',   'Inserisci nuovo articolo. &Egrave; consigliabile inserire dei testi brevi sul tema trattato, possibilmente in minuscolo');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        '');
        $this->setVariable('formBreadCrumbCategory', 'Amministrazione Trasparente');
        $this->setVariable('CKEditorField', array('sottotitolo','testo'));
    }
}