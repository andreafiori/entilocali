<?php

namespace Admin\Model\ContrattiPubblici\Settori;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  04 March 2015
 */
class SettoriFormDataHandler extends FormDataAbstract
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

        $form = new SettoriForm();
        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = $recordFromDb[0]['nome'];
            $formAction = $param['route']['formsetter'].'/update/';
        } else {
            $formTitle = 'Nuovo settore contratti pubblici';
            $submitButtonValue = 'Inserisci';
            $formAction = $param['route']['formsetter'].'/insert/';
        }

        $this->setVariables( array(
                'formTitle'                  => $formTitle,
                'formDescription'            => 'Compila i dati relativi a un ente terzo a cui inviare documenti',
                'form'                       => $form,
                'formAction'                 => $formAction,
                'submitButtonValue'          => $submitButtonValue,
                'formBreadCrumbCategory'     => 'Settori contratti pubblici',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/'.$param['route']['formsetter'],
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
            $wrapper = new SettoriGetterWrapper(
                new SettoriGetter($this->getInput('entityManager',1))
            );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }
    }
}
