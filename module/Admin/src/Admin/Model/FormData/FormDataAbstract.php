<?php

namespace Admin\Model\FormData;

use Admin\Model\InputSetupAbstract;

/**
 * TODO: 
 *     check if can show form, get Form object (based on input)
 * 
 * @author Andrea Fiori
 * @since  20 May 2014
 */
abstract class FormDataAbstract extends InputSetupAbstract
{
    protected $form;
    
    protected $title, $description, $formAction;
    
    protected $record;

    protected $template = 'formdata/formdata.phtml';    
}
