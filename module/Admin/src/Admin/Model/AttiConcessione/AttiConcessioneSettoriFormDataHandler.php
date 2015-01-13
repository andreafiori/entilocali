<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class AttiConcessioneSettoriFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        
        if (isset($param['route']['option'])) {
            $wrapper = new AttiConcessioneSettoriGetterWrapper( new AttiConcessioneSettoriGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('id' => $param['route']['option'], 'limit' => 1) );
            $wrapper->setupQueryBuilder();
            
            $records = $wrapper->getRecords();
        }
        
        $form = new AttiConcessioneSettoriForm();
        
        if (isset($records)) {
            $formAction = '';
            $formTitle = $records[0]['nome'];
            $formDescription = 'Inserisci nuovo settore atti di concessione';
            
            $form->setData($records[0]);
        } else {
            $formAction = '';
            $formTitle = 'Nuovo settore atti di concessione';
            $formDescription = 'Modifica settore atti di concessione';
        }
                
        $this->setVariable('formTitle',         $formTitle);
        $this->setVariable('formDescription',   $formDescription);
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        $formAction);
        $this->setVariable('formBreadCrumbCategory', 'Settori atti di concessione');
        $this->setVariable('CKEditorField', array('sottotitolo','testo'));
    }
}
