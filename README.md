Entilocali project for Kronoweb.it
============================================

[![Build Status](https://travis-ci.org/andreafiori/entilocali.svg?branch=master)](https://travis-ci.org/andreafiori/entilocali)

Introduction
--------------

    The application is still under construction

I'm building this application to restyle an old CMS made with flat PHP long time ago for the company.
This is intended to manage data for public administrations and small companies.

Installation
-------------------

    php composer.phar self-update
    php composer.phar install
    
To update the dependencies and optimize the autoloader for better performances:

    composer update --optimize-autoloader

Rename the a.htaccess file to .htaccess. I've renamed it to use on my localhost Windows XAMPP enviroment.

A sample of the MySQL database dump file is on the sql directory.
The doctrine files represents the updated structure of all db tables

Description
-------------------

This index.php file on the root allows to use this application on a shared hosting.
The vendor file will be shared with multiple applications on the same VPS.

The public directory contains frontend, backend and common assets, views and templates.

The application uses Amazon S3 to store static attachment files: 
Here is the singleton class I've used:

    S3 class: https://github.com/tpyo/amazon-s3-php-class
    
Code documentation
------------------------

The code documentation can be generated using the apigen.phar.
For more info: <a href="http://www.apigen.org" target="_blank">ApiGen</a>

