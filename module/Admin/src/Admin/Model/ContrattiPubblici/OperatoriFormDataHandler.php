<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  26 June 2014
 */
class OperatoriFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $form = new OperatoriForm();
        // $form->setData();
        
        $this->setVariable('formTitle',         'Nuovo operatore');
        $this->setVariable('formDescription',   'Inserisci nuovo operatore contratti pubblici');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        '');
        $this->setVariable('formBreadCrumbCategory', 'Operatori contratti pubblici');
    }
}