<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetter;
use Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetterWrapper;

class AttiConcessioneRespFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);

        $form = new AttiConcessioneRespProcForm();
        
        if (isset($param['route']['option'])) {
            $wrapper = new AttiConcessioneRespProcGetterWrapper( new AttiConcessioneRespProcGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('id' => $param['route']['option'], 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();
        }

        if (!empty($records)) {
            $formAction = 'atticoncessione-resp-proc/insert/';
            $formTitle = 'Modifica responsabile';
            $formDescription = 'Modifica responsabile';

            $form->setData($records[0]);
        } else {
            $formAction = 'atticoncessione-resp-proc/insert/';
            $formTitle = 'Nuovo responsabile';
            $formDescription = 'Inserisci responsabile';
        }

        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        $formAction);
        $this->setVariable('formTitle',         $formTitle);
        $this->setVariable('formDescription',   $formDescription);
        $this->setVariable('formBreadCrumbCategory', 'Amministrazione Trasparente');
    }
}