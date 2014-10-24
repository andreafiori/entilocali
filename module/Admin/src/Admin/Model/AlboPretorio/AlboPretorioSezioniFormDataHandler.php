<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\AlboPretorio\AlboPretorioSezioniForm;
use Admin\Model\AlboPretorio\AlboPretorioRecordsGetter;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class AlboPretorioSezioniFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);

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

        $this->setVariables(array(
                'formTitle' => $formTitle,
                'formDescription' =>  'Inserisci dati nuova sezione albo pretorio',
                'form' => $form,
                'formAction' => $formAction,
                'formBreadCrumbCategory' => 'Sezioni albo pretorio',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl',1).'datatable/albo-pretorio-sezioni/',
            )
        );

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
