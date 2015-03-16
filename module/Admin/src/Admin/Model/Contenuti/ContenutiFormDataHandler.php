<?php

namespace Admin\Model\Contenuti;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

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

        $configurations = $this->getInput('configurations', 1);

        $recordFromDb = $this->getContenutiRecord(isset($param['route']['option']) ? $param['route']['option'] : null);
        $this->setRecord($recordFromDb);

        $form = new ContenutiForm();
        $form->addSottoSezioni($this->getSottoSezioniRecords(array(
            'excludeId'             => isset($configurations['amministrazione_trasparente_sottosezione_id']) ? $configurations['amministrazione_trasparente_sottosezione_id'] : null,
            'excludeSezioneId'      => isset($configurations['amministrazione_trasparente_sezione_id']) ? $configurations['amministrazione_trasparente_sezione_id'] : null,
            'showToAll'             => ($this->isRole(array('WebMaster'))) ? null : 1,
        )));
        $form->addForm();

        /* ACL Check to show user select box or not */
        if ( in_array( $this->getUserDetails()->role, array('WebMaster', 'SuperAdmin')) ) {
            $form->addUsers($this->getUsersRecords(array(
                'orderBy' => 'u.name'
            )));
        }

        $form->addHomeBox();

        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = 'Modifica contenuto';
            $formDescription = null;
            $formAction = 'contenuti/update/';
        } else {
            $form->addSocial();

            $formTitle = 'Nuovo contenuto';
            $formDescription = 'Inserisci i dati relativi al contenuto';
            $submitButtonValue = 'Inserisci';
            $formAction = 'contenuti/insert/';
        }

        $baseUrl = $this->getInput('baseUrl', 1);

        $this->setVariables( array(
                'form'                   => $form,
                'formAction'             => $formAction,
                'formTitle'              => $formTitle,
                'formDescription'        => $formDescription,
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
                $wrapper->setInput( array(
                        'id'     => $id,
                        'limit'  => 1,
                        'utente' => in_array( $this->getUserDetails()->role, array('WebMaster', 'SuperAdmin')) ? null : $this->getUserDetails()->id
                    )
                );
                $wrapper->setupQueryBuilder();

                return $wrapper->getRecords();
            }

            return null;
        }

        /**
         * @param array $input
         * @return array
         */
        private function getSottoSezioniRecords($input = array())
        {
            $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
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

        /**
         * @param array $input
         * @return array
         */
        private function getUsersRecords($input = array())
        {
            $wrapper = new UsersGetterWrapper( new UsersGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();

            $arrayToReturn = array();
            if (!empty($records)) {
                foreach($records as $record) {
                    $arrayToReturn[$record['id']] = utf8_encode($record['name']). ' '.utf8_encode($record['surname']);
                }
            }

            return $arrayToReturn;
        }
}