<?php

namespace Admin\Model\Assistenza;

use Admin\Model\FormData\FormDataAbstract;

/**
 * TODO: do not show insert form
 * 
 * @author Andrea Fiori
 * @since  31 May 2013
 */
class AssistenzaFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
    }
}