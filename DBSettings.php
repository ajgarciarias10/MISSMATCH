<?php

        
        
    //Connecting to the database//
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    define('DB_HOST','localhost');
    define('DB_NAME','MissMatch');
    define('DB_USER','root');
    define('DB_PASS','131202');
    require_once('DBConnection.php');
    $dbh = new DBConnection();
    $con = $dbh -> getCon();
    


?>