<?php

namespace Application\Model\Posts;

use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\Posts\PostsFrontendHelper;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    protected $postsGetterWrapper;
    
    /**
     * Generate main array record for the index frontend controller
     * 
     * @return array
     * @throws \Application\Model\NullException
     */
    public function setupRecord()
    {
        $postsFrontendHelper = new PostsFrontendHelper($this->getInput());
        
        // if isHomePage, set HomePage data
        if ( $postsFrontendHelper->isHomePage() ) {
            $this->setTemplate('homepage/homepage.phtml');
            
            return $this->getOutput();
        }
        
        $this->setRecords($postsFrontendHelper->setRecords());
        $this->setTemplate($postsFrontendHelper->getTemplate());
        
        return $this->getOutput();
    }
}