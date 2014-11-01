<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\FormData\FormDataAbstract;

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
        
        $form = new AlboPretorioArticoliForm();
        $form->addSezioni($this->getSezioni(new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($this->getInput('entityManager')))));
        $form->addLastFields();
        $form->addScadenze();
        
        $records = $this->getArticolo(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($this->getInput('entityManager'))),
                isset($param['route']['option']) ? $param['route']['option'] : null
        );
        
        if (is_array($records) and count($records)==1)
        {
            $form->setData($records[0]);
   
            $formAction = 'albo-pretorio/update/'.$records[0]['id'];
            $formTitle = $records[0]['titolo'];
            
        } else {
            $formAction = 'albo-pretorio/insert/';
            $formTitle = 'Nuovo atto';
        }
        
        $this->setVariables(array(
                'form' => $form,
                'formAction' => $formAction,
                'formTitle' => $formTitle,
                'formDescription' => "Compila i dati relativi all'atto da inserire sull'albo pretorio",

                'formBreadCrumbCategory' => 'Albo pretorio',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/albo-pretorio/'
            )
        );
    }

    /**
     * 
     * @param \Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper $recodsGetter
     * @param int $id
     * @return array|null
     */
    public function getArticolo(AlboPretorioArticoliGetterWrapper $recodsGetter, $id)
    {
        if (is_numeric($id)) {
            $recodsGetter->setInput( array('id' => $id) );
            $recodsGetter->setupQueryBuilder();

            return $recodsGetter->getRecords();
        }
    }
    
    /**
     * 
     * @param \Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper $recodsGetter
     * @return type
     */
    public function getSezioni(AlboPretorioSezioniGetterWrapper $recodsGetter)
    {
        $recodsGetter->setInput(array());
        $recodsGetter->setupQueryBuilder();

        return $recodsGetter->getRecords();
    }
}
