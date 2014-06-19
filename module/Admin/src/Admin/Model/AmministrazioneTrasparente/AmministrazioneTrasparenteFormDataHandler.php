<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class AmministrazioneTrasparenteFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $form = new AmministrazioneTrasparenteForm();
        $form->addSezione();
        $form->addEndForm();
        
        $this->setVariable('formTitle',         'Nuovo articolo');
        $this->setVariable('formDescription',   'Inserisci nuovo articolo. &Egrave; consigliabile inserire dei testi brevi sul tema trattato, possibilmente in minuscolo');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        '');
        $this->setVariable('formBreadCrumbCategory', 'Amministrazione Trasparente');
        $this->setVariable('CKEditorField', array('sottotitolo','testo'));
    }
}