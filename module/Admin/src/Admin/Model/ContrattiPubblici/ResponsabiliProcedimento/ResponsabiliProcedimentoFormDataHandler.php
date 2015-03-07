<?php

namespace Admin\Model\ContrattiPubblici\ResponsabiliProcedimento;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class ResponsabiliProcedimentoFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $form = new ResponsabiliProcedimentoForm();
        
        $param = $this->getInput('param',1);
        
        if ((isset($param['route']['option']))) {
            $records = $this->getResponsabiliRecord($param['route']['option']);
            
            if ($records) {
                $form->setData($records[0]);
                
                $formAction = 'contratti-pubblici-responsabili/update';
                $formTitle = 'Modifica responsabile procedimento';
                $formDescription = 'Modifica nome responsabile procedimenti per i contratti pubblici';
            }
            
        } else {
            $formAction = 'contratti-pubblici-responsabili/insert';
            $formTitle = 'Nuovo responsabile procedimento';
            $formDescription = 'Inserisci un nome responsabile procedimenti per i contratti pubblici';
        }
        
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        $formAction);
        $this->setVariable('formTitle',         $formTitle);
        $this->setVariable('formDescription',   $formDescription);       
        $this->setVariable('formBreadCrumbCategory', 'Contratti pubblici');
        $this->setVariable('formLabelSpanWidth', 3);
        $this->setVariable('formControlSpanWidth', 9);
    }
    
        /**
         * @param number $id
         * @return array|null
         */
        private function getResponsabiliRecord($id)
        {
            if (!is_numeric($id)) {
                return false;
            }
 
            $responsabili = new ResponsabiliProcedimentoGetterWrapper(new ResponsabiliProcedimentoGetter($this->getInput('entityManager',1)) );
            $responsabili->setInput(array('id' => $id));
            $responsabili->setupQueryBuilder();
            
            return  $responsabili->getRecords();
        }
}