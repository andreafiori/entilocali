<?php

namespace ModelModule\Model;

/**
 * @since  30 July 2014
 * @author Andrea Fiori
 */
class VarExporter extends InputSetupAbstract
{
    protected $title, $description;
    
    protected $records;
    
    protected $template;
    
    protected $varToExport = array();

    /**
     * Set a variable to export and use on FormDataHandler
     * 
     * @param string $key, string $value
     * @param array $value
     */
    public function setVariable($key, $value)
    {
        $this->varToExport[$key] = $value;
        
        return $this->varToExport;
    }
    
    /**
     * @param array $vars
     * @return array
     */
    public function setVariables(array $vars)
    {
        foreach($vars as $key => $value) {
            $this->setVariable($key, $value);
        }

        return $this->varToExport;
    }

    /**
     * @param null $key
     * @param null $noArray
     *
     * @return array|null
     */
    public function getVarToExport($key = null, $noArray = null)
    {
        if (isset($this->varToExport[$key])) {
            return $this->varToExport[$key];
        }
        
        if (!$noArray) {
            return $this->varToExport;
        }

        return null;
    }
    
    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        
        return $this->template;
    }
    
    /**
     * @param string $title
     * @return string
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this->title;
    }
    
    /**
     * @param string $description
     * @return string
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this->description;
    }
    
    /**
     * @param array $records
     * @return array
     */
    public function setRecords($records)
    {
        $this->records = $records;
        
        return $this->records;
    }

    /**
     * @return array|null
     */
    public function getRecords()
    {
        return $this->records;
    }
    
    /**
     * @return string $this->template
     */
    public function getTemplate()
    {
        return $this->template;
    }
    
    /**
     * @return array|null
     */    
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @return array|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getUserDetails()
    {
        return $this->getInput('userDetails', 1);
    }

    /**
     * @return \Zend\Permissions\Acl\Acl
     */
    public function getAcl()
    {
        $userDetails = $this->getUserDetails();

        return $userDetails->acl;
    }

    /**
     * @param string|array $roleName
     * @return bool
     */
    protected function isRole($roleName)
    {
        $userRole = $this->getInput('userDetails', 1)->role;

        if (is_array($roleName)) {
            foreach($roleName as $role) {
                if ($role==$userRole) {
                    return true;
                }
            }
        }

        if ($userRole == $roleName) {
            return true;
        }

        return false;
    }
}