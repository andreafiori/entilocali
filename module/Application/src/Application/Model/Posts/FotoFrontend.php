<?php

namespace Application\Model\Posts;

use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Posts\PostsGetter;

/**
 * Generate Foto Records for the Frontend
 * 
 * @author Andrea Fiori
 * @since  06 May 2014
 */
class FotoFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $postsGetterWrapper = new PostsGetterWrapper(new PostsGetter($this->getInput('entityManager')));
        $postsGetterWrapper->setInput( array(
            'categoria' => '',
            'tipo'      => 'foto'
        ));
        $postsGetterWrapper->setupQueryBuilder();
        $foto = $postsGetterWrapper->getRecords();
        
        $this->setTemplate('foto/foto.phtml');
        $this->setVariable('foto', $foto);
        
        return $this->getOutput();
    }   
}