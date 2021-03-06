<?php

namespace ModelModule\Model;

use Zend\Authentication\Storage\Session as SessionStorage;

/**
 * @author Andrea Fiori
 * @since  13 May 2013
 */
class MyAuthStorage extends SessionStorage
{
    /**
     * @param int $time
     */
    public function setRememberMe($time = 10800)
    {
        $this->session->getManager()->rememberMe($time);
    }

    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    }
}