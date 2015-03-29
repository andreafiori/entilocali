<?php

namespace Admin\Model\AttiConcessione;

use Zend\Form\Form;

/**
 * TODO: testo, elenco servizi, stato (tutti, attivo, disattivato), settore, responsabili mese, anno
 */
class AttiConcessioneFormSearchBackend extends Form
{
    /**
     * @inheritdoc
     */
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
    }
}