<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Sezioni\SezioniGetter;
use Admin\Model\Sezioni\SezioniGetterWrapper;
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

        $form = new AmministrazioneTrasparenteForm();
        $form->addSezione( array() );
        $form->addEndForm();
        
        // check Sezioni
        $wrapper = new SezioniGetterWrapper( new SezioniGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput(array());
        $wrapper->setupQueryBuilder();
        
        // check Sotto-sezioni
        $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($this->getInput('entityManager',1)) );
        $wrapper->setInput(array());
        $wrapper->setupQueryBuilder();
        // $sottosezioniRecords = $wrapper->getRecords();
        
        if (isset($param['route']['option'])) {
            $record = $this->getArticoloRecord($param['route']['option']);
        }
        
        if (isset($record)) {
            $formAction      = 'amministrazione-trasparente/update';
            $formTitle       = 'Modifica articolo';
            $formDescription = 'Modifica articolo. &Egrave; consigliabile inserire dei testi brevi sul tema trattato, possibilmente in minuscolo';

            $form->setData($record[0]);
        } else {
            $formAction      = 'amministrazione-trasparente/insert';
            $formTitle       = 'Nuovo articolo';
            $formDescription = 'Inserisci nuovo articolo. &Egrave; consigliabile inserire dei testi brevi sul tema trattato, possibilmente in minuscolo';
        }

        $this->setVariables(array(
            'formTitle'       => $formTitle,
            'formDescription' => $formDescription,
            'form'            => $form,
            'formAction'      => $formAction,
            'formBreadCrumbCategory' => 'Amministrazione Trasparente',
            'CKEditorField'          => array('sommario', 'testo'),
        ));
    }
    
        /**
         * @param int $id
         * @return array|null
         */
        private function getArticoloRecord($id)
        {
            $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($this->getInput('entityManager',1)) );
            $wrapper->setInput( array('id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();
            
            return $wrapper->getRecords();
        }
}
