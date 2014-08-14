<?php

// Redbean 3 ORM. The 4th version is only for PHP 5.3.4 or higher
require_once("libraries/rb.php");

$connectionError = '';
if (file_exists("config.php")) {
    
    require_once("config.php");
    
    /* DB connection test */
    try {
        R::setup('mysql:host='.$dbConnection['host'].';dbname='.$dbConnection['dbname'], $dbConnection['user'], $dbConnection['password']);
    } catch (Exception $ex) {
        $connectionError = $ex->getMessage();
    }
    
    /*
    try {
        R::getAll('SELECT * FROM config LIMIT 1');
    } catch (Exception $ex) {
        $connectionError = "Errore selezione sulle tabelle 'vecchio' CMS. ".$ex->getMessage();
    }
    
    try {
        R::getAll('SELECT * FROM zfcms_config LIMIT 1');
    } catch (Exception $ex) {
        $connectionError = "Errore selezione sulle tabelle 'nuovo' CMS. ".$ex->getMessage();
    }
    */

} else {
    $connectionError = 'File con i parametri di configurazione al databse non presente';
}