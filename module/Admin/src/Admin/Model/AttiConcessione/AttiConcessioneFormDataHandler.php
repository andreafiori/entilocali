<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  16 December 2013
 */
class AttiConcessioneFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);

        $form = new AttiConcessioneForm();
        $form->addUfficioResponsabile($this->getSezioni());
        
        $records = $this->getAttiRecords(isset($param['route']['option']) ? $param['route']['option'] : null);
        if ($records) {
            $formAction = 'atti-concessione/update';
            $formTitle = 'Modifica atto di concessione';
            $formDescription = 'Modifica nuovo atto di concessione';
            
            $form->setData($records[0]);
        } else {
            $formAction = 'atti-concessione/insert';
            $formTitle = 'Nuovo atto di concessione';
            $formDescription = 'Inserisci nuovo atto di concessione';
        }
        
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        $formAction);
        $this->setVariable('formTitle',         $formTitle);
        $this->setVariable('formDescription',   $formDescription);        
        $this->setVariable('formBreadCrumbCategory', 'Atti di concessione');
        $this->setVariable('CKEditorField', array('sottotitolo','testo'));
    }
    
        /**
         * @param type $id
         * @return type
         */
        private function getAttiRecords($id)
        {
            $wrapper = new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($this->getInput('entityManager',1)));
            $wrapper->setInput( array('aa.id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();
            
            return $wrapper->getRecords();
        }
        
        private function getSezioni()
        {
            $wrapper = new AttiConcessioneSettoriGetterWrapper( new AttiConcessioneSettoriGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array() );
            $wrapper->setupQueryBuilder();
            
            $records = $wrapper->getRecords();
            
            $recordForSelectArea = array();
            foreach($records as $record) {
                $valueToPush = $record['nome'];
                if (isset($record['responsabile'])) {
                    $valueToPush .= ' - Responsabile: '.$record['responsabile'];
                }
                $recordForSelectArea[$record['id']] = $valueToPush;
            }
            
            return $recordForSelectArea;
        }
}
