<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\AlboPretorio\AlboPretorioForm;
use Admin\Model\AlboPretorio\AlboPretorioRecordsGetter;
use Admin\Model\AlboPretorio\AlboPretorioRecordsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  22 July 2014
 */
class AlboPretorioFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param',1);
        
        $form = new AlboPretorioForm();
        // $form->addSezioni();
        $form->addLastFields();
        $form->addScadenze();
        
        if (isset($param['route']['option'])) {
            $form->setData( array() );
        }
        
        $this->setVariables(array(
            'form' => $form,
            'formAction' => '',
            'formTitle' => 'Nuovo atto',
            'formDescription' => "Compila i dati relativi all'atto da inserire sull'albo pretorio",
            'formBreadCrumbCategory' => 'Albo pretorio',
            'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/albo-pretorio/'
            )
        );
    }
}
