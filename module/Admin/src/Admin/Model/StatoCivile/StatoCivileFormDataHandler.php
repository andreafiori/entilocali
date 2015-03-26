<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\FormDataAbstract;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileFormDataHandler extends FormDataAbstract
{
    private $param, $entityManager;

    private $recordsGetter;

    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $this->param         = $this->getInput('param', 1);
        $this->entityManager = $this->getInput('entityManager', 1);
        
        $this->recordsGetter = new StatoCivileRecordsGetter($this->getInput());

        $sezioniRecords = $this->getSezioni();

        if (empty($sezioniRecords)) {
            $this->setTemplate('message.phtml');
            $this->setVariables(array(
                'messageType'   => 'warning',
                'messageTitle'  => 'Nessuna sezione presente',
                'messageText'   => "Non &egrave; possibile inserire un nuovo articolo se non esiste almeno una sezione."
            ));
        }

        $form = new StatoCivileForm();
        $form->addSezioni( $sezioniRecords ? $sezioniRecords : array() );
        $form->addDates();
        $form->addId();

        if ( isset($this->param['route']['option']) ) {
            $records = $this->getArticoloRecord($this->param['route']['option']);
        }

        if ( !empty($records) ) {
            $form->setData($records);

            $formAction = 'stato-civile/update/';
        } else {
            $form->setData(array(
                'scadenza'=> date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s"). ' + 8 days')),
            ));
        }

        $this->setVariables(array(
            'formTitle'                     => isset($records['titolo']) ? 'Modifica atto' : 'Nuovo atto stato civile',
            'formDescription'               => '&Egrave; consigliabile inserire testi brevi sul tema trattato, possibilmente in minuscolo',
            'form'                          => $form,
            'formAction'                    => isset($formAction) ? $formAction : $formAction = 'stato-civile/insert/',
            'formBreadCrumbCategory'        => 'Stato civile',
            'formBreadCrumbCategoryLink'    => $this->getInput('baseUrl',1).'datatable/stato-civile/',
            )
        );
    }
    
        /**
         * @param number $id
         * @return array|null
         */
        private function getArticoloRecord($id)
        {
            if (!is_numeric($id)) {
                return false;
            }
 
            $this->recordsGetter->setFirstRow();
            $this->recordsGetter->setArticoli( array('id' => $id) );
            
            return $this->recordsGetter->returnRecordset();
        }
        
        /**
         * @return array|null
         */
        private function getSezioni()
        {
            $this->recordsGetter = new StatoCivileRecordsGetter($this->getInput());
            $this->recordsGetter->setSezioni( array() );
 
            return $this->recordsGetter->formatSezioniForFormSelect('id','nome');
        }
}