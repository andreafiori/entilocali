[![Build Status](https://travis-ci.org/andreafiori/zend2-cms-with-restful-api.svg?branch=master)](https://travis-ci.org/andreafiori/zend2-cms-with-restful-api)

Zend2 CMS with API service
=======================

Introduction
------------

    The application is still under construction!!!

This web application will have a Content Management System to handle contents, blog posts, photo, video.
It must be open to build new modules and use it for companies and public administrations.
All frontend templates must be responsive.

Installation
------------

Get a working copy of this project is to clone the repository and use `composer` to install dependencies using the `create-project` command:

    php composer.phar self-update
    php composer.phar install

The MySQL database dump file is on the sql directory.

Update the application using:
    
    composer update --optimize-autoloader

I have installed composer using the windows setup.

Rename the a.htaccess file to .htaccess. I've renamed it to use on my local XAMPP.

Documentation
------------

Source code documentation can be generated with Apigen.
I have apigen.neon file configuration to generate files on the docs directory.

Notes
------------

This index.php file on the root allows to use this application on a shared hosting.
The public directory contains frontend, backend and common assets, views and templates.
