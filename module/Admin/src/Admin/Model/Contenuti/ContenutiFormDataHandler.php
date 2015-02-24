<?php

namespace Admin\Model\Contenuti;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  11 January 2015
 */
class ContenutiFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getInput('param', 1);

        $recordFromDb = $this->getContenutiRecord(isset($param['route']['option']) ? $param['route']['option'] : null);
        $this->setRecord($recordFromDb);

        $form = new ContenutiForm();
        $form->addSottoSezioni($this->getSezioniRecords());
        $form->addForm();
        // $form->addUsers();

        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = $recordFromDb[0]['titolo'];
            $formAction = 'contenuti/update/';
        } else {
            $form->addSocial();

            $formTitle = 'Nuovo contenuto';
            $submitButtonValue = 'Inserisci';
            $formAction = 'contenuti/insert/';
        }

        $baseUrl = $this->getInput('baseUrl', 1);

        $this->setVariables( array(
                'form'                   => $form,
                'formAction'             => $formAction,
                'formTitle'              => $formTitle,
                'formDescription'        => 'Compila i dati relativi al contenuto',
                'submitButtonValue'      => $submitButtonValue,
                'CKEditorField'          => array('sommario', 'testo'),
                'formBreadCrumbCategory'     => 'Contenuti',
                'formBreadCrumbCategoryLink' => $baseUrl.'datatable/contenuti/',
            )
        );
    }

        /**
         * @param number|null $id
         * @return array|null
         */
        private function getContenutiRecord($id)
        {
            if (is_numeric($id)) {
                $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($this->getInput('entityManager',1)) );
                $wrapper->setInput( array('id' => $id) );
                $wrapper->setupQueryBuilder();

                return $wrapper->getRecords();
            }
        }

        /**
         * @return array
         */
        private function getSezioniRecords()
        {
            $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array() );
            $wrapper->setupQueryBuilder();

            $sezioniRecords = $wrapper->getRecords();

            $arrayToReturn = array();
            if (!empty($sezioniRecords)) {
                foreach($sezioniRecords as $sezioniRecord) {
                    $arrayToReturn[$sezioniRecord['idSottosezione']] = utf8_encode($sezioniRecord['nomeSezione']). ' - '.utf8_encode($sezioniRecord['nomeSottosezione']);
                }
            }

            return $arrayToReturn;
        }
}