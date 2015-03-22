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
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getInput('param', 1);

        $configurations = $this->getInput('configurations', 1);

        $recordFromDb = $this->getSottoSezioniFormRecord(isset($param['route']['option']) ? $param['route']['option'] : null);

        $this->setRecord($recordFromDb);

        $sezioniOptions = $this->getSezioniRecords(array(
            'fields'    => 'sezioni.id, sezioni.nome',
            'id'        => ($param['route']['formsetter']=='sottosezioni-amm-trasparente') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'excludeId' => ($param['route']['formsetter']=='sottosezioni-contenuti') ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'orderBy'   => 'sezioni.nome'
        ));

        if (empty($sezioniOptions)) {
            // error...
            return;
        }

        $form = new SottoSezioniForm();
        $form->addSezioni( $this->formatSezioniRecordsForFormSelect($sezioniOptions) );
        $form->addMainFormInputs();

        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);

            $formTitle  = $recordFromDb[0]['nomeSottosezione'];
            $formAction = 'sottosezioni-contenuti/update/';
            $submitButtonValue = 'Modifica';
        } else {
            $formTitle          = 'Nuova sotto sezione';
            $submitButtonValue  = 'Inserisci';
            $formAction         = 'sottosezioni-contenuti/insert/';
        }

        $baseUrl = $this->getInput('baseUrl', 1);

        $this->setVariables( array(
                'form'                   => $form,
                'formAction'             => $formAction,
                'formTitle'              => $formTitle,
                'formDescription'        => 'Dati relativi alle sotto sezioni',
                'submitButtonValue'      => $submitButtonValue,
                'formBreadCrumbCategory' => 'Sotto sezioni',
                'formBreadCrumbCategoryLink' => $baseUrl.'datatable/sottosezioni-contenuti/',
            )
        );
    }

        /**
         * @param int|null $id
         * @return array|null
         */
        private function getSottoSezioniFormRecord($id)
        {
            if (is_numeric($id)) {
                $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getInput('entityManager',1)) );
                $wrapper->setInput( array('id' => $id, 'limit' => 1) );
                $wrapper->setupQueryBuilder();

                return $wrapper->getRecords();
            }

            return null;
        }

        /**
         * @param array $input
         *
         * @return array
         */
        private function getSezioniRecords(array $input)
        {
            $wrapper = new SezioniGetterWrapper( new SezioniGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }

        /**
         * @param array $records
         *
         * @return array
         */
        private function formatSezioniRecordsForFormSelect(array $records)
        {
            $arrayToReturn = array();
            foreach($records as $record) {
                $arrayToReturn[$record['id']] = $record['nome'];
            }
            return $arrayToReturn;
        }
}