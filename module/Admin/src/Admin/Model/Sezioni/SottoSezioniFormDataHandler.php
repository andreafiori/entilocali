<?php

namespace Admin\Model\Sezioni;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  18 February 2014
 */
class SottoSezioniFormDataHandler extends FormDataAbstract
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

        $form = new SottoSezioniForm();

        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';

            $formTitle = $recordFromDb[0]['nomeSezione'].' - '.$recordFromDb[0]['nomeSottosezione'];
            $formAction = 'sottosezioni-contenuti/update/';
        } else {
            $formTitle = 'Nuova sotto sezione';
            $submitButtonValue = 'Inserisci';
            $formAction = 'sottosezioni-contenuti/insert/';
        }

        $this->setVariables( array(
                'formTitle'              => $formTitle,
                'formDescription'        => 'Dati relativi alle sotto sezioni',
                'form'                   => $form,
                'formAction'             => $formAction,
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => 'Sotto sezioni',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/sottosezioni-contenuti/',
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
            $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }
    }
}