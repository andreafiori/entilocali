<?php

namespace Admin\Model\Sezioni;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  15 February 2014
 */
class SezioniFormDataHandler extends FormDataAbstract
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

        $form = new SezioniForm();
        $form->addLingue(array());
        $form->addOptions();

        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = $recordFromDb[0]['nome'];
            $formAction = 'sezioni-contenuti/update/';
        } else {
            $formTitle = 'Nuova sezione';
            $submitButtonValue = 'Inserisci';
            $formAction = 'sezioni-contenuti/insert/';
        }

        $this->setVariables( array(
                'formTitle'              => $formTitle,
                'formDescription'        => 'Le sezioni rappresentano i blocchi principali sui quali costruire le basi dei contenuti',
                'form'                   => $form,
                'formAction'             => $formAction,
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => 'Sezioni',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/sezioni-contenuti/',
            )
        );
    }

    /**
     * @param int|null $id
     * @return array|null
     */
    private function getFormRecord($id)
    {
        if (is_numeric($id)) {
            $wrapper = new SezioniGetterWrapper( new SezioniGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }
    }
}
