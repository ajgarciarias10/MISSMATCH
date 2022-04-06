
    <?php
        require_once('header.php');
    ?>
        <?php
            setcookie('Prueba','Probando');//Crear  (user_id, token, serial)
           // echo $_COOKIE['Prueba'];//
          /*  setcookie('Prueba',NULL,time()-3600);//Cargarse una cookie*/
        ?>
     
   <div class="preloader"> 
       <p class="spacerUp"></p>
       <p>Loading...</p>
       <img class="preloader-icon" src="loadericon.gif" alt="My Site Preloader"> 
       <p class="spacerBottom"></p>
   </div>
   
    <div class="container-fluid">
        <div class="row fila1">
            <div class="col-md-12 col-sm-28 col-xs-24 picture1"></div>
        </div>
        
        
        
    </div>
    <?php
        require_once('footer.php');
    ?>