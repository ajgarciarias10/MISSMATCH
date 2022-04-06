<?php
require_once('header.php');
?>
<?php define('hola', 'images/');?>
<?php

  $id = $_GET['user_id'];
  $sql = "SELECT * FROM  `users` WHERE user_id = ".$id.";";
  $row=$dbh->getQuery($sql)->fetch();
?>
<div class="main">
    <div class ="grid-container">
        <div class="row">
            <div class="col-lg-7">
                <center>
                <div class="title"> <b><?php echo($row['user_username']);?></b> </div>
                </center>
                <div class="details">
                    <table class="table bio">
                        <tr>
                            <td><b>NATIONALITY</b></td>
                            <td><b><?php echo($row['user_state']);?> &nbsp;</b></td>
                        </tr>
                        <tr>
                            <td><b>CITY</b></td>
                            <td><b><?php echo($row['user_city']);?></b></td>
                        </tr>
                        <tr>
                            <td><b>First Name</b></td>
                            <td><b><?php echo($row['user_firstname']);?></b></td>
                        </tr>
                        <tr>
                            <td><b>SURNAME</b></td>
                            <td><b><?php echo($row['user_username']);?></b></td>
                        </tr>
                        <tr>
                            <td><b>BIRTHDATE</b></td>
                            <td><b><?php echo($row['user_birthdate']);?></b></td>
                            
                        </tr>
                    </table> <br><br>
                    <center>
                        <td><b>GENDER</b></td>
                        <p class="stats z-depth-4"><span class="one"><?php 
                                                                      if($row['user_gender'] == 1){
                                                                          echo"Masculino";
                                                                      }else{
                                                                          echo"Femenino";
                                                                      }
                                                                    ?>
                    </center>
                </div>
            </div>
            <div class="col-lg-5"> 
                    <img class="imagenPerfil" src="<?php echo(hola.$row['user_picture']);?>">
            </div>
        </div>
    </div>
</div>



