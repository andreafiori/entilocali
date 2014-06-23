<?php

namespace Admin\Model;

use Zend\Authentication\Storage;

/**
 * @author Andrea Fiori
 * @since  13 May 2013
 */
class MyAuthStorage extends Storage\Session
{
    /**
     * @param number $time
     */
    public function setRememberMe($time = 1209600)
    {
        $this->session->getManager()->rememberMe($time);
    }
    
    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    }
}