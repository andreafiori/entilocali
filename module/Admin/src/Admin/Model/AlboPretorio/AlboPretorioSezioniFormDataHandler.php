<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\AlboPretorio\AlboPretorioSezioniForm;
use Admin\Model\AlboPretorio\AlboPretorioRecordsGetter;

class AlboPretorioSezioniFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param         = $this->getInput('param', 1);

        $form = new AlboPretorioSezioniForm();
        
        $sezione = $this->getSezione($param['route']['option']);
        if ($sezione) {
            $formTitle = $sezione['nome'];
            $form->setData($sezione);
            $formAction = 'albo-pretorio-sezioni/update/'.$sezione['id'];
        } else {
            $formTitle = 'Nuova sezione albo pretorio';
            $formAction = 'albo-pretorio-sezioni/insert/';
        }

        $this->setVariable('formTitle',         $formTitle);
        $this->setVariable('formDescription',   'Inserisci dati nuova sezione albo pretorio');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        $formAction);

        $this->setVariable('formBreadCrumbCategory', 'Sezioni albo pretorio');
        $this->setVariable('formBreadCrumbCategoryLink', $this->getInput('baseUrl',1).'datatable/albo-pretorio-sezioni/');
    }
    
        /**
         * @param number $id
         * @return array
         */
        private function getSezione($id)
        {
            $alboPretorioRecordsGetter = new AlboPretorioRecordsGetter($this->getInput());
            $alboPretorioRecordsGetter->setSezioni( array("id" => $id) );
            $alboPretorioRecordsGetter->setFirstRow();
            
            return $alboPretorioRecordsGetter->returnRecordset();
        }
}
