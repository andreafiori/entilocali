<?php

namespace Admin\Model\StatoCivile;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\StatoCivile\StatoCivileSezioniForm;
use Admin\Model\StatoCivile\StatoCivileSezioniGetter;
use Admin\Model\StatoCivile\StatoCivileSezioniGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class StatoCivileSezioniFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
   
        $form = new StatoCivileSezioniForm();

        if (isset($param['route']['option'])) {
            
            if (is_numeric($param['route']['option'])) {
                $statoCivileSezioniGetterWrapper = new StatoCivileSezioniGetterWrapper( new StatoCivileSezioniGetter($this->getInput('entityManager', 1)) );
                $statoCivileSezioniGetterWrapper->setInput(array('scs.id' => $param['route']['option']));
                $statoCivileSezioniGetterWrapper->setupQueryBuilder();

                $record = $statoCivileSezioniGetterWrapper->getRecords();
            }
        }

        if (!empty($record)) {
            $form->setData($record[0]);
            $formAction = 'stato-civile-sezioni/update';
            $formTitle = 'Modifica sezione stato civile';
        } else {
            $formAction = 'stato-civile-sezioni/insert';
            $formTitle = 'Nuova sezione stato civile';
        }

        $this->setVariables(array(
                'form'                       => $form,
                'formAction'                 => $formAction,
                'formTitle'                  => $formTitle,
                'formDescription'            => 'Compila il form e premi il pulsante per confermare',
                'formBreadCrumbCategory'     => 'Sezioni stato civile',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl',1).'datatable/stato-civile-sezioni',
            )
        );
    }
}