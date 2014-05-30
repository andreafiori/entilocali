<?php

namespace Admin\Model\FormData;

use Admin\Model\InputSetupAbstract;

/**
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
