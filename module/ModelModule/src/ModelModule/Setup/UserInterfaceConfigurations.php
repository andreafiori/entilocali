<?php

namespace ModelModule\Setup;

class UserInterfaceConfigurations
{
    private $configurations;

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