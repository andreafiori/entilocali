<?php

namespace Admin\Model;

use Admin\Model\InputSetupAbstract;

/**
 * Input Setter Abstraction for FormData and DataTables child objects
 * 
 * @author Andrea Fiori
 * @since  31 May 2014
 */
class InputSetupTemplateAbstract extends InputSetupAbstract
{
    protected $template;
    
    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        
        return $this->template;
    }

    /**
     * @return string $this->template
     */
    public function getTemplate()
    {
        return $this->template;
    }
}