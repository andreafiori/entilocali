<?php

namespace Admin\Model\ContrattiPubblici;

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
        $form->setData( array() );
        
        $this->setVariable('formTitle',         'Nuovo responsabile procedimento');
        $this->setVariable('formDescription',   '');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        $this->getFormAction());
        $this->setVariable('formBreadCrumbCategory', 'Contratti pubblici');
        $this->setVariable('formLabelSpanWidth', 3);
        $this->setVariable('formControlSpanWidth', 9);
    }
    
        /**
         * @return string
         */
        private function getFormAction()
        {
            return '#';
        }
}