<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\StatoCivile\StatoCivileSezioniForm;
use Admin\Model\StatoCivile\StatoCivileSezioniGetter;
use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class StatoCivileSezioniFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param          = $this->getInput('param', 1);
        $entityManager  = $this->getInput('entityManager', 1);
        
        $statoCivileSezioniForm = new StatoCivileSezioniForm();
        
        $statoCivileSezioniGetterWrapper = new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($entityManager) );
        
        $this->setVariables(array(
                'formTitle' => 'Nuova sezione stato civile',
                'formDescription' => 'Inserisci i dati e premi il pulsante per confermare',
                'form' => $statoCivileSezioniForm,
                'formAction' => '',
                
                'formBreadCrumbCategory' => array('Stato civile'),
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl',1).'datatable/stao-civile-sezioni',
            )
        );
    }
}