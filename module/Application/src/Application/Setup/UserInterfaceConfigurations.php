<?php

namespace Application\Setup;

use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\InputSetupAbstract;

/**
 * @author Andrea Fiori
 * @since  30 April 2014
 */
class UserInterfaceConfigurations extends InputSetupAbstract
{
    private $configurations;
    
    private $postsGetterWrapper;

    /**
     * @param array $configurations
     */
    public function setConfigurations(array $configurations)
    {
        $this->configurations = $configurations;
        
        $this->frontendKeysToCheck  = array("projectdir_frontend", "template_name");
        $this->backendKeysToCheck   = array("template_backend", "template_project");
    }
    
    /**
     * 
     * @param type $isBackend
     * @return type
     */
    public function setConfigurationsArray($isBackend = false)
    {
        if ($isBackend) {
            $this->configurations['template_project']     = 'backend/';
            $this->configurations['template_name']        = isset($this->configurations['template_backend']) ? $this->configurations['template_backend'] : 'default/';
            $this->configurations['template_path']        = $this->configurations['template_project'].'templates/'.$this->configurations['template_name'];
            $this->configurations['preloader_class']      = isset($this->configurations['preloader_backend']) ? $this->configurations['preloader_backend'] : '';

            $this->configurations['loginActionBackend']       = $this->configurations['template_project'].'login/';
            $this->configurations['logoutPathBackend']        = $this->configurations['template_project'].'logout/';
            $this->configurations['loggedSectionPathBackend'] = $this->configurations['template_project'].'main/';
        } else {
            $this->configurations['template_project']     = 'frontend/projects/'.$this->configurations['projectdir_frontend'];
            $this->configurations['template_name']        = $this->configurations['template_frontend'] ? $this->configurations['template_frontend'] : 'default/';
            $this->configurations['template_path']        = $this->configurations['template_project'].'templates/'.$this->configurations['template_name'];
        }
        
        return $this->configurations;
    }
    
    /**
     * @return array
     */
    public function setPreloadResponse($entityManager)
    {
        $this->assertPostsGetterWrapper($entityManager);
        
        $this->postsGetterWrapper->setupQueryBuilder();
        $this->postsGetterWrapper->setupPaginator( $this->postsGetterWrapper->setupQuery( $this->getInput('entityManager', 1) ) );
        $this->postsGetterWrapper->setupPaginatorCurrentPage(1);
        $this->postsGetterWrapper->setupPaginatorItemsPerPage(35);
        
        $postsList = $this->postsGetterWrapper->setupRecords();
        if ($postsList) {
            foreach($postsList as $preload) {
                if ( !isset($preload['categoryName']) ) {
                    break;
                }
                
                $this->configurations['preloadResponse'][$preload['categoryName']][] = $preload;
            }
        }
        
        return $this->configurations;
    }
    
    /**
     * @param \Admin\Model\Posts\PostsGetterWrapper $postsGetterWrapper
     * @return \Admin\Model\Posts\PostsGetterWrapper
     */
    public function setPostsGetterWrapper(PostsGetterWrapper $postsGetterWrapper)
    {
        $this->postsGetterWrapper = $postsGetterWrapper;
        
        return $this->postsGetterWrapper;
    }
    
        /**
         * @param type $entityManager
         * @return type
         */
        private function assertPostsGetterWrapper(\Doctrine\ORM\EntityManager $entityManager)
        {
            if ($this->postsGetterWrapper) {
                return;
            }
            
            $this->postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($entityManager) );
            $this->postsGetterWrapper->setInput( array_merge(
                    $this->getInput(),
                    array(
                        'type'  => array('content', 'blog'),
                        'status' => \Admin\Model\Posts\PostsUtils::STATE_ACTIVE 
                    )
                )
            );
            
            return $this->postsGetterWrapper;
        }

    /**
     * Set common configurations both for backend and frontend
     */
    public function setCommonConfigurations()
    {
        $this->configurations['basiclayout'] = $this->configurations['template_path'].'layout.phtml';
        $this->configurations['imagedir']    = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'].'assets/images/';
        $this->configurations['cssdir']      = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'].'assets/css/';
        $this->configurations['jsdir']       = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'].'assets/js/';
    }

    /**
     * @return array $this->configurations
     */
    public function getConfigurations()
    {
        return $this->configurations;
    }
}