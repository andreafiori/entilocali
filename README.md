[![Build Status](https://travis-ci.org/andreafiori/Zend2APICMS.png?branch=master)](https://travis-ci.org/andreafiori/Zend2APICMS)

Zend2 CMS with API service
=======================

Introduction
------------

This web application will have a Content Management System to handle contents, blog posts, photo, video.
The application must be open to build new modules and use it for companies and public administrations.
All frontend templates must be responsive.
The application is still under construction.

Installation
------------

Get a working copy of this project is to clone the repository and use `composer` to install dependencies using the `create-project` command:

    php composer.phar self-update
    php composer.phar install

The MySQL database dump file is on the sql directory.

This index.php file on the root allows to use this application on a shared hosting.
I've updated the Basepath.php file on vendor\zendframework\zendframework\library\Zend\View\Helper\BasePath.php:

    /**
     * Set the base path.
     *
     * @param  string $basePath
     * @return self
     */
    public function setBasePath($basePath)
    {
    	if ( RUNNING_FROM_ROOT and !preg_match("/public$/", $basePath)) {
    		 $this->basePath = $basePath.'/public';
    	} else {
    		$this->basePath = rtrim($basePath, '/');
    	}
        return $this;
    }

Rename the a.htaccess file to .htaccess. I've renamed it to use on my local XAMPP.
