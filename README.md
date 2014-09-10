[![Build Status](https://travis-ci.org/andreafiori/zend2-cms-with-restful-api.svg?branch=master)](https://travis-ci.org/andreafiori/zend2-cms-with-restful-api)

[![Coverage Status](https://coveralls.io/repos/andreafiori/zend2-cms-with-restful-api/badge.png)](https://coveralls.io/r/andreafiori/zend2-cms-with-restful-api)

Zend2 CMS with RESTful API
===============================

Introduction
--------------

    The application is still under construction!!!

This web application will have a Content Management System to handle contents, blog posts, photo, video.
It must be open to build new modules and use it for companies and public administrations.
All frontend templates must be responsive.

Installation
-------------------

Get a working copy of this project is to clone the repository and use `composer` to install dependencies using the `create-project` command:

    php composer.phar self-update
    php composer.phar install --optimize-autoloader
    php composer.phar update --optimize-autoloader

The MySQL database dump file is on the sql directory.

Update the application using:
    
    composer update --optimize-autoloader

I have installed composer using the windows setup.

Rename the a.htaccess file to .htaccess. I've renamed it to use on my local XAMPP.

Documentation
-------------------

Source code documentation can be generated with Apigen.
I have apigen.neon file configuration to generate files on the docs directory.

Just another CMS
-------------------

Why build another CMS? This project is created to have multiple website with shared templates using all the modern
technologies we want to use. And then we need custom modules to handle websites for the public administrations.
The accessibility on the frontend will be very important.

Migration tool
-------------------

This CMS is based on another old CMS! 
This one was developed many years ago with plain PHP and now we want to renew all modules 
and establish a new standard for this application.
The old CMS is on more than 80 websites on production and this tool will help the migration of all data on previous database.

Notes
------------

This index.php file on the root allows to use this application on a shared hosting.
The public directory contains frontend, backend and common assets, views and templates.
