<?php

namespace Application\Model\Posts;

use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  06 May 2014
 */
class PhotoFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $this->setTemplate('foto/foto.phtml');
        $this->setVariable('foto', $this->getPhotoRecords(new PostsGetterWrapper(new PostsGetter($this->getInput('entityManager')))) );
        
        return $this->getOutput();
    }
    
        /**
         * @param \Admin\Model\Posts\PostsGetterWrapper $postsGetterWrapper
         * @return \Admin\Model\Posts\PostsGetterWrapper
         */
        private function getPhotoRecords(PostsGetterWrapper $postsGetterWrapper)
        {
            $postsGetterWrapper->setInput( array( 'type' => 'foto' ));
            $postsGetterWrapper->setupQueryBuilder();

            return $postsGetterWrapper->getRecords();
        }
}