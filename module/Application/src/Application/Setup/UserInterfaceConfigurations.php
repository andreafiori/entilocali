<?php

namespace Application\Setup;

use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  30 April 2014
 */
class UserInterfaceConfigurations
{
    private $configurations;
    
    private $postsGetterWrapper;

    /**
     * @param array $configurations
     */
    public function  __construct(array $configurations)
    {
        $this->configurations = $configurations;
    }

    /**
     * @return array
     */
    public function setAdditionalFrontendConfigurationsArray()
    {
        $this->configurations['template_project']   = 'frontend/projects/'.$this->configurations['projectdir_frontend'];
        $this->configurations['template_name']      = $this->configurations['template_frontend'] ? $this->configurations['template_frontend'] : 'default/';
        $this->configurations['template_path']      = $this->configurations['template_project'].'templates/'.$this->configurations['template_name'];

        $this->setCommonConfigurations();

        return $this->configurations;
    }
    
    /**
     * @param int $isBackend
     * @return array
     */
    public function setAdditionalAdminConfigurationsArray()
    {
        $this->configurations['template_project']     = 'backend/';
        $this->configurations['template_name']        = isset($this->configurations['template_backend']) ? $this->configurations['template_backend'] : 'default/';
        $this->configurations['template_path']        = $this->configurations['template_project'].'templates/'.$this->configurations['template_name'];
        $this->configurations['preloader_class']      = isset($this->configurations['preloader_backend']) ? $this->configurations['preloader_backend'] : '';

        $this->configurations['loginActionBackend']       = $this->configurations['template_project'].'login/';
        $this->configurations['logoutPathBackend']        = $this->configurations['template_project'].'logout/';
        $this->configurations['loggedSectionPathBackend'] = $this->configurations['template_project'].'main/';

        $this->setCommonConfigurations();
        
        return $this->configurations;
    }
    
    /**
     * @return array
     */
    public function setPreloadResponse($entityManager)
    {
        $wrapper = new PostsGetterWrapper(new PostsGetter($entityManager));
        $wrapper->setInput(array(
				'limit' => '50',
				'type'  => array('content', 'blog'),
				'status' => \Admin\Model\Posts\PostsUtils::STATE_ACTIVE 
			)
		);
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($entityManager) );
        
        $postsList = $wrapper->setupRecords();
        
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
     * @return array $this->configurations
     */
    public function getConfigurations()
    {
        return $this->configurations;
    }

        /**
         * Set common configurations both for backend and frontend
         */
        private function setCommonConfigurations()
        {
            $this->configurations['basiclayout'] = $this->configurations['template_path'].'layout.phtml';
            $this->configurations['imagedir']    = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'].'assets/images/';
            $this->configurations['cssdir']      = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'].'assets/css/';
            $this->configurations['jsdir']       = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'].'assets/js/';
            $this->configurations['templatedir'] = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'];
        }
}