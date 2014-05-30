<?php

namespace Application\Setup;

use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Posts\PostsGetter;

/**
 * Validate and initialize configuration array
 * 
 * @author Andrea Fiori
 * @since  30 April 2014
 */
class UserInterfaceConfigurations
{
    private $configurations;
        
    /**
     * @param array $configurations
     */
    public function __construct(array $configurations)
    {
        $this->configurations = $configurations;
        
        $this->frontendKeysToCheck  = array("projectdir_frontend", "template_name");
        $this->backendKeysToCheck   = array("template_backend", "template_project");
    }
    
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
     * TODO: select module on db and add record on configurations array
     * 
     * @param type $isBackend
     */
    public function setModules($isBackend = false)
    {
        if ($isBackend) {
            
        }
    }
    
    /**
     * @return array
     */
    public function setPreloadResponse($entityManager)
    {
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($entityManager) );
        $postsGetterWrapper->setInput( array(
                'tipo'   => 'content',
                'stato'  => \Admin\Model\Posts\PostsStatus::STATE_ACTIVE,
        ));
        $postsGetterWrapper->setupQueryBuilder();
        $postsList = $postsGetterWrapper->getRecords();
        if ($postsList) {
            foreach($postsList as $preload) {
                if ( !isset($preload['nomeCategoria']) ) {
                    break;
                }
                
                $this->configurations['preloadResponse'][$preload['nomeCategoria']][] = $preload;
            }
        }
        
        return $this->configurations;
    }

    /**
     * Set common configurations both for backend and frontend
     */
    public function setCommonConfigurations()
    {
        $this->configurations['basiclayout'] = $this->configurations['template_path'].'layout.phtml';
        
	$this->configurations['imagedir'] = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'].'assets/images/';
	$this->configurations['cssdir']   = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'].'assets/css/';
	$this->configurations['jsdir']    = 'public/'.$this->configurations['template_project'].'templates/'.$this->configurations['template_name'].'assets/js/';
    }

    /**
     * @return array $this->configurations
     */
    public function getConfigurations()
    {
        return $this->configurations;
    }
}