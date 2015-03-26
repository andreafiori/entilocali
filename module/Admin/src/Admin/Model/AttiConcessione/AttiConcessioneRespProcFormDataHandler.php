<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\FormDataAbstract;

class AttiConcessioneRespProcFormDataHandler extends FormDataAbstract
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
            $wrapper = new AttiConcessioneRespProcGetterWrapper(
                new AttiConcessioneRespProcGetter($this->getInput('entityManager',1))
            );
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

        $baseUrl = $this->getInput('baseUrl', 1);

        $this->setVariables(array(
            'form'                   => $form,
            'formAction'             => $formAction,
            'formTitle'              => $formTitle,
            'formDescription'        => $formDescription,
            'formBreadCrumbCategoryLink' => $baseUrl.'datatable/atticoncessione-resp-proc/',
            'formBreadCrumbCategory' => 'Atti di concessione',
        ));
    }
}