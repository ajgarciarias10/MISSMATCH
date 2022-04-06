<?php
    
    if(!isset($_SESSION)){
        session_start();
    }
    
    setCookie('user_id', null, time() - (500), "/");
    setCookie('username', null, time() - (500), "/");
    setCookie('token', null, time() - (500), "/");
    setCookie('serial', null, time() - (500), "/");
    
    session_destroy();
    session_unset();
    
    header("location: index.php");
?>