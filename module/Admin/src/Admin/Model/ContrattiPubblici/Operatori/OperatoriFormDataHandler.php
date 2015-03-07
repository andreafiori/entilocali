<?php

namespace Admin\Model\ContrattiPubblici\Operatori;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  26 June 2014
 */
class OperatoriFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $form = new OperatoriForm();
        $param = $this->getInput('param',1);

        $recordFromDb = $this->getFormRecord(isset($param['route']['option']) ? $param['route']['option'] : null);
        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = $recordFromDb[0]['nome'];
            $formAction = 'contratti-pubblici-operatori/update/';
        } else {
            $formTitle = 'Nuovo operatore';
            $submitButtonValue = 'Inserisci';
            $formAction = 'contratti-pubblici-operatori/insert/';
        }

        $this->setVariables( array(
                'form'                   => $form,
                'formAction'             => $formAction,
                'formTitle'              => $formTitle,
                'formDescription'        => 'Compila dati operatore abilitato a partecipare ai bandi di gara e contratti pubblici',
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => 'Operatori contratti pubblici',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/contratti-pubblici-operatori/',
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
                $wrapper = new OperatoriGetterWrapper( new OperatoriGetter($this->getInput('entityManager',1)) );
                $wrapper->setInput( array('id' => $id, 'limit' => 1) );
                $wrapper->setupQueryBuilder();

                return $wrapper->getRecords();
            }
        }
}