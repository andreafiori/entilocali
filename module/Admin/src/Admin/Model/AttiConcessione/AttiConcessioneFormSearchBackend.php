<?php

namespace Admin\Model\AttiConcessione;

use Zend\Form\Form;

/**
 * TODO: testo, elenco servizi, stato (tutti, attivo, disattivato), mese, anno
 */
class AttiConcessioneFormSearchBackend extends Form
{
    /**
     * 
     * @param type $name
     * @param type $options
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        
    }
}