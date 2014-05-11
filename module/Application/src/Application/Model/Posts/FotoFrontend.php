<?php

namespace Application\Model\Posts;

use Application\Model\FrontendHelpers\FrontendRouterInterface;
use Application\Model\FrontendHelpers\FrontendRouterAbstract;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Posts\PostsGetter;

/**
 * Generate Foto Records for the Frontend
 * 
 * @author Andrea Fiori
 * @since  06 May 2014
 */
class FotoFrontend extends FrontendRouterAbstract implements FrontendRouterInterface
{
    public function setupFrontendRecord()
    {
        $this->output['template']  = 'foto/foto.phtml';
        
        return $this->output;
    }
    
}