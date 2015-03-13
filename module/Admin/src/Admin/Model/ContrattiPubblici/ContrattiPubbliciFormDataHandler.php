<?php

namespace Admin\Model\ContrattiPubblici;

use Admin\Model\ContrattiPubblici\ResponsabiliProcedimento\ResponsabiliProcedimentoGetter;
use Admin\Model\ContrattiPubblici\ResponsabiliProcedimento\ResponsabiliProcedimentoGetterWrapper;
use Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetter;
use Admin\Model\ContrattiPubblici\SceltaContraente\SceltaContraenteGetterWrapper;
use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  26 June 2014
 */
class ContrattiPubbliciFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getInput('param', 1);

        $form = new ContrattiPubbliciForm();
        $form->addSceltaContraente($this->getSceltaContraente());
        $form->addResponsabili($this-> getResponsabiliProcedimento());
        $form->addDatePubblicazione();
        $form->addNumeroOfferteEDate();

        $routeOptionId = isset($param['route']['option']) ? $param['route']['option'] : null;
        if ($routeOptionId) {
            $records = $this->getFormRecord($routeOptionId);
        }

        if (!empty($records)) {
            $formAction         = $param['route']['formsetter'].'/update';
            $formTitle          = 'Modifica bando';

            $form->setData($records[0]);
        } else {
            $form->setData( array("insertDate" => date("Y-m-d"), "expireDate" => date("2030-m-d")) );

            $formAction      = $param['route']['formsetter'].'/insert';
            $formTitle       = 'Nuovo bando';
        }

        $baseUrl = $this->getInput('baseUrl', 1);

        $this->setVariables(array(
            'form'                       => $form,
            'formAction'                 => $formAction,
            'formTitle'                  => $formTitle,
            'formDescription'            => '&Egrave; consigliabile inserire testi brevi sul tema trattato, possibilmente in minuscolo.',
            'formBreadCrumbCategory'     => 'Contratti pubblici',
            'formBreadCrumbCategoryLink' => $baseUrl.'datatable/contratti-pubblici/',
            'formLabelSpanWidth'         => 3,
            'formControlSpanWidth'       => 9,
        ));
    }

        /**
         * @param number|null $id
         *
         * @return array|null
         */
        private function getFormRecord($id)
        {
            if (is_numeric($id)) {
                $wrapper = new ContrattiPubbliciGetterWrapper( new ContrattiPubbliciGetter($this->getInput('entityManager',1)) );
                $wrapper->setInput( array('id' => $id, 'limit' => 1) );
                $wrapper->setupQueryBuilder();

                return $wrapper->getRecords();
            }
        }

        /**
         * @param array $input
         *
         * @return array|bool
         */
        private function getSceltaContraente($input = array())
        {
            $wrapper = new SceltaContraenteGetterWrapper( new SceltaContraenteGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();
            if (!empty($records)) {
                $toReturn = array();
                foreach($records as $record) {
                    $toReturn[$record['id']] = $record['nomeScelta'];
                }
                return $toReturn;
            }

            return false;
        }

        private function getResponsabiliProcedimento($input = array())
        {
            $wrapper = new ResponsabiliProcedimentoGetterWrapper( new ResponsabiliProcedimentoGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();
            if (!empty($records)) {
                $toReturn = array();
                foreach($records as $record) {
                    $toReturn[$record['id']] = $record['nomeResp'];
                }
                return $toReturn;
            }

            return false;
        }
}