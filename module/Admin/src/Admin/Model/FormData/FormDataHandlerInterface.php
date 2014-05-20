<?php

namespace Admin\Model\FormData;

/**
 * @author Andrea Fiori
 * @since  20 May 2014
 */
interface FormDataHandlerInterface
{
    public function getForm();
    
    public function getFormAction();
    
    public function getTitle();
    
    public function getDescription();
}
