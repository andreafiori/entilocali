<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class AmministrazioneTrasparenteFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getInput('param', 1);

        // Form
        $form = new AmministrazioneTrasparenteForm();
        $form->addSezione($this->recoverSottoSezioniOptions());
        $form->addEndForm();

        if (isset($param['route']['option'])) {
            $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('id' => $param['route']['option'], 'limit' => 1) );
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();
        }

        if (isset($records)) {
            $formAction      = 'amministrazione-trasparente/update';
            $formTitle       = 'Modifica articolo';
            $formDescription = 'Modifica articolo. &Egrave; consigliabile inserire dei testi brevi sul tema trattato, possibilmente in minuscolo';

            $form->setData($records[0]);
        } else {
            $form->addSocial();
            $form->setData(array(
                'anno'         => date("Y"),
                'dataScadenza' => date('Y-m-d', strtotime('+5 years')),
            ));

            $formAction      = 'amministrazione-trasparente/insert';
            $formTitle       = 'Nuovo articolo';
            $formDescription = 'Inserisci nuovo articolo. &Egrave; consigliabile inserire dei testi brevi sul tema trattato, possibilmente in minuscolo';
        }

        $baseUrl = $this->getInput('baseUrl', 1);

        $this->setVariables(array(
            'formTitle'              => $formTitle,
            'formDescription'        => $formDescription,
            'form'                   => $form,
            'formAction'             => $formAction,
            'formBreadCrumbCategory' => 'Amministrazione Trasparente',
            'formBreadCrumbCategoryLink' => $baseUrl.'datatable/amministrazione-trasparente/',
            'CKEditorField'          => array('sommario', 'testo'),
        ));
    }

        /**
         * TODO: too bad: section select from tree...
         *
         * @return array
         */
        private function recoverSottoSezioniOptions()
        {
            $configurations = $this->getInput('configurations', 1);

            // Check Sotto-sezioni
            $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput(array(
                'sezioneId' => $configurations['amministrazione_trasparente_sezione_id'],
            ));
            $wrapper->setupQueryBuilder();
            $sottosezioniRecords = $wrapper->getRecords();

            $sezioniOptions = array();
            foreach($sottosezioniRecords as $sottosezione) {

                if (isset($sottosezione['profonditaDa'])) {
                    $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getInput('entityManager',1)) );
                    $wrapper->setInput(array(
                        'sezioneId' => $configurations['amministrazione_trasparente_sezione_id'],
                        'profonditaDa' => ''
                    ));
                    $wrapper->setupQueryBuilder();

                    $sottosezioniRecords2 = $wrapper->getRecords();
                    if (!empty($sottosezioniRecords2)) {
                        foreach($sottosezioniRecords2 as $sottosezione2) {
                            if (isset($sottosezione['idSottosezione'])) {
                                $sezioniOptions[$sottosezione['idSottosezione']] = $sottosezione['nomeSottosezione'].' > '.$sottosezione2['nomeSottosezione'];
                            }
                        }
                    }
                } else {
                    if (isset($sottosezione['idSottosezione'])) {
                        $sezioniOptions[$sottosezione['idSottosezione']] = $sottosezione['nomeSezione'].' > '.$sottosezione['nomeSottosezione'];
                    }
                }
            }

            return $sezioniOptions;
        }
}
