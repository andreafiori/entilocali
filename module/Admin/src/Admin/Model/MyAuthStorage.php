<?php

namespace Admin\Model;

use Zend\Authentication\Storage;

/**
 * @author samsonasik
 * @since  13 May 2013
 */
class MyAuthStorage extends Storage\Session
{
    /**
     * @param number $rememberMe
     * @param number $time
     */
    public function setRememberMe($rememberMe = 0, $time = 1209600)
    {
        if ($rememberMe == 1) {
            $this->session->getManager()->rememberMe($time);
        }
    }
    
    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    } 
}