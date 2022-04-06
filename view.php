<?php
require_once('header.php');

?>
<?php define('hola', 'images/');?>
        
<?php

 ?>

<section id="t-cards">
    <div class="container">
        <div class="row">
                    <?php
                        $sql = "SELECT user_id, user_picture, user_username FROM `users` WHERE NOT user_id = " . $_SESSION['user_id'] ;
                        $res = $dbh-> getQuery($sql);
                        $rows = $res -> fetchAll(PDO::FETCH_ASSOC);
                        
                        $cadena = "";
                        
                        foreach($rows as $row){
                        $cadena .=  "<div class='col-sm-3 col-md-4'>";
                        $cadena .=     " <div class='card d-flex mx-auto'>";
                        $cadena .=          "<div class='card-body'>";
                        $cadena .=              "<div class='card-image'>";
                        $cadena .=                  "<img class='img-fluid d-flex mx-auto' src=" . hola . $row['user_picture'] . " alt='Card image cap'/>";
                        $cadena .=               "</div>";
                        $cadena .=               "<div class='card-text'>";
                        $cadena .=                  "<h5 class='card-title'>".$row['user_username']."</h5>";
                        $cadena .=               "</div>";
                        $cadena .=                "<a href='profile.php?user_id=" . $row['user_id'] . "' class='btn btn-primary'>View Profiles</a>"  ;  
                        $cadena .=          "</div>";
                        $cadena .=      "</div>";
                        $cadena .= "</div>";
                        }
                        echo $cadena;
                    ?>
        </div>
    </div>
</section>