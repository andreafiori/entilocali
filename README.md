[![Build Status](https://travis-ci.org/andreafiori/zend2-cms-with-restful-api.svg?branch=master)](https://travis-ci.org/andreafiori/zend2-cms-with-restful-api)

[![Coverage Status](https://coveralls.io/repos/andreafiori/zend2-cms-with-restful-api/badge.png)](https://coveralls.io/r/andreafiori/zend2-cms-with-restful-api)

Zend2 CMS with RESTful API
===============================

Introduction
--------------

    The application is still under construction!!!

I'm building this application to restyle an old CMS made with flat PHP long time ago for a company.
This is intended to manage data for public administrations and companies.

Installation
-------------------

Get a working copy of this project is to clone the repository and use `composer` to install dependencies using the `create-project` command:

    php composer.phar self-update
    php composer.phar install

The MySQL database dump file is on the sql directory.

Update third part scripts using:
    
    composer update --optimize-autoloader

Rename the a.htaccess file to .htaccess. I've renamed it to use on my localhost with XAMPP.

Documentation
-------------------

Source code documentation can be generated with Apigen.
I have apigen.neon file configuration to generate files on the docs directory.

Migration tool
-------------------

A migration tool will 

Notes
------------

This index.php file on the root allows to use this application on a shared hosting.
The public directory contains frontend, backend and common assets, views and templates.
