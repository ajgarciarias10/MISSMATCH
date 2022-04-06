<?php
require_once('function.php');
require_once('DBSettings.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>MISSMATCH</title>
  </head>
  <body>
   
   <div class="container-fluid" >
        <div class="row">
           <header>
                <div class="logo"></div> 
                <nav>
                    <?php
                            $logged = func::checkLogin($con);
                            $script = $_SERVER['PHP_SELF'];
                           // $logged  = 0;
                            if ( $script == '/PHP/PPR5/MissMatch/login.php') {
                                $url="location.href='index.php'";
                                $value="Home";
                                
                                //echo $url; exit;
                            }
                            if ( $script == '/PHP/PPR5/MissMatch/register.php') {
                                $url="location.href='index.php'";
                                $value="Home";
                          
                            }
                            if ( $script == '/PHP/PPR5/MissMatch/index.php' && !$logged) {
                                $url="location.href='login.php'";
                                $value = 'Log in';
                             
                                //echo $url; exit;
                            }
                            if($script != '/PHP/PPR5/MissMatch/index.php'){
                                $url="location.href='index.php'";
                                $value = 'Home';
                            }
                            if(isset($value))
                                echo('<button onclick='.$url.' class="btn btn-primary" type="submit">'. $value .'</button>&nbsp;');

                            if ($logged) { ?>
                                 <button onclick="location.href='view.php'" class="btn btn-primary" type="submit">View Profiles</button>&nbsp; 
                                 <button onclick="location.href='edit.php'" class="btn btn-primary" type="submit">Edit my profile</button>&nbsp; 
                                 <button onclick="location.href='question.php'" class="btn btn-primary" type="submit">Questionnaire</button>&nbsp; 
                                 <button onclick="location.href='mismatch.php'" class="btn btn-primary" type="submit">My Mismatch</button>&nbsp; 
                                 <button onclick="location.href='logout.php'" class="btn btn-primary" type="submit">Log out</button> 
                            <?php } ?>
                </nav>
           </header>   
        </div>
    </div>
    