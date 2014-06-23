<?php

namespace Application\Model\HomePage;

use Admin\Model\InputSetupAbstract;

/**
 * @author Andrea Fiori
 * @since  22 June 2014
 */
class HomePageSetup extends InputSetupAbstract
{
    private $homePageInput;
    
    /**
     * @param array or null $homePageInput
     * @return boolean
     */
    public function setHomePageInput($homePageInput = null)
    {
        if (!is_array($homePageInput)) {
            return false;
        }
        
        $this->homePageInput = $homePageInput;
        
        return $this->homePageInput;
    }
    
}