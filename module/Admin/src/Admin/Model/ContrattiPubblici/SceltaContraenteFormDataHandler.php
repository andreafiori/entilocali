<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\ContrattiPubblici\SceltaContraenteForm;
use Admin\Model\ContrattiPubblici\SceltaContraenteGetter;
use Admin\Model\ContrattiPubblici\SceltaContraenteGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  14 August 2014
 */
class SceltaContraenteFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        
        $recordFromDb = $this->getFormRecord($param['route']['option']);
        $this->setRecord($recordFromDb);
        
        $form = new SceltaContraenteForm();
        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);
        } else {
            
        }
        
        $this->setVariables( array(
                'formTitle'              => 'Scelta del contraente',
                'formDescription'        => '',
                'form'                   => $form,
                'formAction'             => '',
                'submitButtonValue'      => 'Inserisci',
                'formBreadCrumbCategory' => 'Contratti pubblici',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/albo-pretorio/',
            )
        );
    }
    
    public function getFormRecord($id)
    {
        if (is_numeric($id)) {
            $sceltaContraenteGetterWrapper = new SceltaContraenteGetterWrapper( new SceltaContraenteGetter($this->getInput('entityManager',1)) );
            $sceltaContraenteGetterWrapper->setInput( array('id'=>$id) );
            $sceltaContraenteGetterWrapper->setupQueryBuilder();
            
            return $sceltaContraenteGetterWrapper->getRecords();
        }
    }
    
    public function getFormAction()
    {
        
    }
}
