<?php

namespace Admin\Model\EntiTerzi;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class EntiTerziFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        
        $recordFromDb = $this->getFormRecord(isset($param['route']['option']) ? $param['route']['option'] : null);

        $this->setRecord($recordFromDb);
        
        $form = new EntiTerziForm();
        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);
            $submitButtonValue = 'Modifica';
            $formTitle = 'Modifica Ente';
            $formAction = 'enti-terzi/update/';
        } else {
            $formTitle = 'Nuovo ente terzo';
            $submitButtonValue = 'Inserisci';
            $formAction = 'enti-terzi/insert/';
        }
        
        $this->setVariables( array(
                'formTitle'              => $formTitle,
                'formDescription'        => "Compila i dati relativi a all'ente terzo",
                'form'                   => $form,
                'formAction'             => $formAction,
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => 'Enti terzi',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/enti-terzi/',
            )
        );
    }
    
        /**
         * @param int $id
         * @return array|null
         */
        private function getFormRecord($id)
        {
            if (is_numeric($id)) {
                $wrapper = new EntiTerziGetterWrapper( new EntiTerziGetter($this->getInput('entityManager',1)) );
                $wrapper->setInput( array('id' => $id, 'limit' => 1) );
                $wrapper->setupQueryBuilder();

                return $wrapper->getRecords();
            }
        }
}
