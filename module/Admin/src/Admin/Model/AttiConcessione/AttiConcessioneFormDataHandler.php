<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetter;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetterWrapper;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteSezioniGetter;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteSezioniGetterWrapper;

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
        $this->getAttiRecords($param['route']['option']);
        $form->addUfficioResponsabile($this->getSezioni());

        $this->setVariable('formTitle',         'Nuovo atto di concessione');
        $this->setVariable('formDescription',   'Inserisci nuovo atto di concessione');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        '');
        $this->setVariable('formBreadCrumbCategory', 'Amministrazione Trasparente');
        $this->setVariable('CKEditorField', array('sottotitolo','testo'));
    }
    
        /**
         * @param type $id
         * @return type
         */
        private function getAttiRecords($id)
        {
            $wrapper = new AmministrazioneTrasparenteGetterWrapper(new AmministrazioneTrasparenteGetter($this->getInput('entityManager',1)));
            $wrapper->setInput( array('aa.id' => $id) );
            $wrapper->setupQueryBuilder();
            
            return $wrapper->getRecords();
        }
        
        private function getSezioni()
        {
            $wrapper = new AmministrazioneTrasparenteSezioniGetterWrapper( new AmministrazioneTrasparenteSezioniGetter($this->getInput('entityManager',1)) );
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