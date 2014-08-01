<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\AlboPretorio\AlboPretorioForm;
use Admin\Model\AlboPretorio\AlboPretorioRecordsGetter;

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
        
        $form = new AlboPretorioForm();
        
        $this->setVariable('formTitle',         'Nuovo atto');
        $this->setVariable('formDescription',   '');
        $this->setVariable('form',              $form);
        $this->setVariable('formAction',        '');

        $this->setVariable('formBreadCrumbCategory', 'Albo pretorio');
        $this->setVariable('formBreadCrumbCategoryLink', $this->getInput('baseUrl', 1).'datatable/albo-pretorio/');
    }

        private function getAtti()
        {
            
        }
}
