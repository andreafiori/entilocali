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

        $sezione = $this->getSezione(
            new AlboPretorioRecordsGetter($this->getInput()),
            isset($param['route']['option']) ? $param['route']['option'] : null
        );
        
        $form = new AlboPretorioSezioniForm();
        if ($sezione) {
            $form->setData($sezione);
            $formTitle = $sezione['nome'];
            $formAction = 'albo-pretorio-sezioni/update/'.$sezione['id'];
        } else {
            $formTitle = 'Nuova sezione albo pretorio';
            $formAction = 'albo-pretorio-sezioni/insert/';
        }

        $this->setVariables(array(
                'formTitle'         => $formTitle,
                'formDescription'   =>  'Inserisci dati nuova sezione albo pretorio',
                'form'              => $form,
                'formAction'        => $formAction,
                'formBreadCrumbCategory'        => 'Sezioni albo pretorio',
                'formBreadCrumbCategoryLink'    => $this->getInput('baseUrl',1).'datatable/albo-pretorio-sezioni/',
            )
        );

    }
    
        /**
         * @param number $id
         * @return array|null
         */
        public function getSezione(AlboPretorioRecordsGetter $alboPretorioRecordsGetter, $id)
        {
            if (is_numeric($id)) {
                $alboPretorioRecordsGetter->setSezioni( array("id" => $id, 'limit'=>1) );
                $alboPretorioRecordsGetter->setFirstRow();

                return $alboPretorioRecordsGetter->returnRecordset();   
            }
        }
}
