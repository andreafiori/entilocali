<?php

namespace Admin\Model\ContrattiPubblici\SceltaContraente;

use Admin\Model\FormData\FormDataAbstract;

/**
 * Scelta contraente contratti pubblici, gestore form
 *
 * @author Andrea Fiori
 * @since  14 August 2014
 */
class SceltaContraenteFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);
        
        $recordFromDb = isset($param['route']['option']) ? $this->getFormRecord($param['route']['option']) : null;
        $this->setRecord($recordFromDb);
        
        $form = new SceltaContraenteForm();
        if ($recordFromDb) {
            $form->setData($recordFromDb[0]);
            
            $formAction = 'contratti-pubblici-scelta-contraente/update';
            $formTitle = 'Modifica voce scelta del contraente';
            $formDescription = 'Modifica scelta contraente';
        } else {
            $formAction = 'contratti-pubblici-scelta-contraente/insert';
            $formTitle = 'Nuova voce scelta del contraente';
            $formDescription = 'Inserisci voce scelta contraente';
        }
        
        $this->setVariables( array(
                'form'                   => $form,
                'formAction'             => $formAction,
                'formTitle'              => $formTitle,
                'formDescription'        => $formDescription,
                'submitButtonValue'      => 'Conferma',
                'formBreadCrumbCategory' => 'Contratti pubblici',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/albo-pretorio/',
            )
        );
    }

    /**
     * @param $id
     *
     * @return \Application\Model\QueryBuilderHelperAbstract
     */
    public function getFormRecord($id)
    {
        if (is_numeric($id)) {
            $sceltaContraenteGetterWrapper = new SceltaContraenteGetterWrapper( new SceltaContraenteGetter($this->getInput('entityManager',1)) );
            $sceltaContraenteGetterWrapper->setInput( array('csc.id' => $id) );
            $sceltaContraenteGetterWrapper->setupQueryBuilder();
            
            return $sceltaContraenteGetterWrapper->getRecords();
        }
    }
}
