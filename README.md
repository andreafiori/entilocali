[![Build Status](https://travis-ci.org/andreafiori/Zend2APICMS.png?branch=master)](https://travis-ci.org/andreafiori/Zend2APICMS)

Zend2 CMS with API service
=======================

This web application is work in progress...

Introduction
------------
This web application will have a Content Management System to handle contents, blog posts, photo and video. 
NOTE: This application is proprietary and still under construction. There will be a demo version on this repository ASAP.

Installation
------------

Get a working copy of this project is to clone the repository and use `composer` to install dependencies using the `create-project` command:

    php composer.phar self-update
    php composer.phar install
	
The .sql file with the MySQL database is on the sql directory.

This index.php file on the root allows to use this application on a shared hosting but I've updated the Basepath.php file on the Zend framwework.

Rename the a.htaccess file to .htaccess. I've renamed it to use on my local XAMPP.
