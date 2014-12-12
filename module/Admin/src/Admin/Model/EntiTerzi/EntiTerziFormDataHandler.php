<?php

namespace Admin\Model\Entiterzi;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class EntiTerziFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        
        $recordFromDb = $this->getFormRecord(isset($param['route']['option']) ? $param['route']['option'] : null);
        $this->setRecord($recordFromDb);
        
        $form = new EntiterziForm();
        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);
            $submitButtonValue = 'Modifica';
            $formTitle = $recordFromDb[0]['nome'];
            $formAction = 'enti-terzi/update/';
        } else {
            $formTitle = 'Nuovo ente terzo';
            $submitButtonValue = 'Inserisci';
            $formAction = 'enti-terzi/insert/';
        }
        
        $this->setVariables( array(
                'formTitle'              => $formTitle,
                'formDescription'        => 'Compila i dati relativi a un ente terzo a cui inviare documenti',
                'form'                   => $form,
                'formAction'             => $formAction,
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => 'Enti terzi',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/enti-terzi/',
            )
        );
    }
    
        /**
         * @param number|null $id
         * @return array|null
         */
        private function getFormRecord($id)
        {
            if (is_numeric($id)) {
                $wrapper = new EntiTerziGetterWrapper( new EntiTerziGetter($this->getInput('entityManager',1)) );
                $wrapper->setInput( array('id' => $id) );
                $wrapper->setupQueryBuilder();

                return $wrapper->getRecords();
            }
        }
}
