<?php
require_once('header.php');
ini_set('display_errors', 1);
define('GW_UPLOADPATH', 'images/');///Define la ruta para subir la foto que inserte el usuario a la carpeta fotos.

function createSerial($length){
    //funcion para que el usuario no pueda introducir un mismo fichero
    
    $frase="modedQEEQDHETO79Pcevtoybuijkolp13EDR231+ertfyguhijoklwserdtfyguhijoerxtyuiopdefedeffeddADdedeADADBGWFEd31452367awTYKU64532E3RFGREHTExtintorte dejaré mi tractor";
   $serial="";
   mt_srand(time());//Semilla 
        for($i=1;$i<=$length;$i++){
         $serial .= substr($frase, mt_rand(0,strlen($frase)),3);
         //(.=)Concatenamos todo y utilizamos substr = Devuelve una parte del string definida por los parámetros start=0 y length=strlen($frase).
        }
         echo 'Serial:'.$serial;//Imprimimos en pantalla
        return $serial;
}

//Vemos si el formulario ha sido enviado. Si lo hemos enviado el elemento 'submit' de $_POST existe
        if (isset($_POST['submit']))
        {  if (isset($_POST['username']) && isset($_POST['password'])){
                 $user = $_POST ['username'];
                 $pass = sha1($_POST ['password']);
                 $firstname =$_POST['user_name'] ;
                 $surname=$_POST['user_surname'];
  
                  //METODO DATE TIME 
                  $d = new DateTime('now');
                  $d->format('Y-m-d');
                $birthdate = $_POST['user_birthdate'];
                $d =$birthdate;
                $city=$_POST['user_city'];
                $picture = $_FILES['user_picture'];
                $country = $_POST['user_state'];
                $gender = $_POST['user_gender'];
                
                $sql="UPDATE `users`  SET user_username = :user_username ,  user_password = :user_password , user_state = 0 , user_firstname = :user_firstname ,
                              user_lastname = :user_lastname , user_gender = :user_gender ,  user_birthdate = :user_birthdate , user_city =:user_city
                              , user_picture = :user_picture , user_state = :user_state where user_id =".$_SESSION['user_id'].";";
                $stmt =  $con->prepare($sql);
                $params = array(':user_username'=>$user,
                                ':user_password'=>$pass,
                                ':user_firstname'=>$firstname,
                                ':user_lastname'=>$surname,
                                ':user_gender' => $gender,
                                ':user_birthdate'=>$d,
                                ':user_city'=>$city,
                                ':user_picture'=>$picture['name'],
                                ':user_state'=>$country,);
                $stmt -> execute($params); 
                $row = $stmt ->fetch(PDO::FETCH_ASSOC);
                header("location: index.php");
                //var_dump($row);}
                     // $target = substr($newplayer->getName(),0,15)."-".createSerial(5).".".pathinfo($name,PATHINFO_EXTENSION);
          
                if ($_FILES['user_picture']['error'] == 0)//Comprobacion si se han producido eerrores checkeando el valor que devuelve el array asociativo $_FILES
                {
                           $tmpname= $_FILES['user_picture']['tmp_name'];
                            $name=GW_UPLOADPATH.$_FILES['user_picture']['name'];
                
                    if(move_uploaded_file($tmpname,$name))
                     
                    {
                        $error=0;
                       $errormsg= '<span class="good">Your file has been uploaded</span>';
                    }
                    else
                    {
                    $error=0;
                    $errormsg='<span class="fail">Your file has not been uploaded</span>';
                        
                    }
                }

        
            }
        
        }
 

?> 
    <div class="container">
         <div class="message">
        <?php
        if (isset($error))
        {
            echo "<span class='error" . $error . "'>" . $errormsg . '</span>';
        }
        ?>  
        </div>
        <div class="foto"> 
        </div>
        <div class="row">
           <form class="register" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" method="post">
             <?php
                        $sql = "SELECT * FROM `users` WHERE  user_id = " . $_SESSION['user_id'] ;
                        $res = $dbh-> getQuery($sql);
                        $rows = $res -> fetchAll(PDO::FETCH_ASSOC);
                        foreach($rows as $row){
              ?>
              <div class="row mb-3">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="username" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo($row['user_username'])?>">
                </div>
              </div>
              <div class="row mb-3">
                <label for="pasword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="pasword" name="password" placeholder="Type your password">
                </div>
              </div>
               <div class="row mb-3">
                <label for="user_name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                  <input type="user_name" class="form-control" id="user_name" name="user_name" placeholder="Type First Name" value="<?php echo($row['user_firstname'])?>">
                </div>
              </div>
                <div class="row mb-3">
                <label for="user_surname" class="col-sm-2 col-form-label">Surname</label>
                <div class="col-sm-10">
                  <input type="user_surname" class="form-control" id="user_surname" name="user_surname" placeholder="Type Surname" value="<?php echo($row['user_lastname'])?>">
                </div>
              </div>
              <div class="row mb-3">
                <label for="birthdate" class="col-sm-2 col-form-label">Birthdate</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="birthdate" name="user_birthdate" value="<?php echo($row['user_birthdate'])?>">
                </div>
              </div>
               <div class="row mb-3">
                <label for="city" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-10">
                  <input type="city" class="form-control" id="city" name="user_city" value="<?php echo($row['user_city'])?>">
                </div>
              </div>
                <div class="col-sm-3">
                  <label for="formFileLg" class="col-sm-2 col-form-label">Change your picture</label>
                  <input type="hidden"  name="MAX_FILE_SIZE" value="100000000"/>
                    <input class="form-control form-control-lg" name="user_picture" id="formFileLg" type="file">
            </div>
              <div class="col-sm-3">
                <label for="user_state" class="col-sm-2 col-form-label">Country
                   <select name="user_state">
                        <option value="<?php $row['user_state']?>"></option>
                        <option value="AF">Afganistán</option>
                        <option value="AL">Albania</option>
                        <option value="DE">Alemania</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguilla</option>
                        <option value="AQ">Antártida</option>
                        <option value="AG">Antigua y Barbuda</option>
                        <option value="AN">Antillas Holandesas</option>
                        <option value="SA">Arabia Saudí</option>
                        <option value="DZ">Argelia</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AT">Austria</option>
                        <option value="AZ">Azerbaiyán</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahrein</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BB">Barbados</option>
                        <option value="BE">Bélgica</option>
                        <option value="BZ">Belice</option>
                        <option value="BJ">Benin</option>
                        <option value="BM">Bermudas</option>
                        <option value="BY">Bielorrusia</option>
                        <option value="MM">Birmania</option>
                        <option value="BO">Bolivia</option>
                        <option value="BA">Bosnia y Herzegovina</option>
                        <option value="BW">Botswana</option>
                        <option value="BR">Brasil</option>
                        <option value="BN">Brunei</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina Faso</option>
                        <option value="BI">Burundi</option>
                        <option value="BT">Bután</option>
                        <option value="CV">Cabo Verde</option>
                        <option value="KH">Camboya</option>
                        <option value="CM">Camerún</option>
                        <option value="CA">Canadá</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="CY">Chipre</option>
                        <option value="VA">Ciudad del Vaticano (Santa Sede)</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comores</option>
                        <option value="CG">Congo</option>
                        <option value="CD">Congo, República Democrática del</option>
                        <option value="KR">Corea</option>
                        <option value="KP">Corea del Norte</option>
                        <option value="CI">Costa de Marfíl</option>
                        <option value="CR">Costa Rica</option>
                        <option value="HR">Croacia (Hrvatska)</option>
                        <option value="CU">Cuba</option>
                        <option value="DK">Dinamarca</option>
                        <option value="DJ">Djibouti</option>
                        <option value="DM">Dominica</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egipto</option>
                        <option value="SV">El Salvador</option>
                        <option value="AE">Emiratos Árabes Unidos</option>
                        <option value="ER">Eritrea</option>
                        <option value="SI">Eslovenia</option>
                        <option value="ES" selected>España</option>
                        <option value="US">Estados Unidos</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Etiopía</option>
                        <option value="FJ">Fiji</option>
                        <option value="PH">Filipinas</option>
                        <option value="FI">Finlandia</option>
                        <option value="FR">Francia</option>
                        <option value="GA">Gabón</option>
                        <option value="GM">Gambia</option>
                        <option value="GE">Georgia</option>
                        <option value="GH">Ghana</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GD">Granada</option>
                        <option value="GR">Grecia</option>
                        <option value="GL">Groenlandia</option>
                        <option value="GP">Guadalupe</option>
                        <option value="GU">Guam</option>
                        <option value="GT">Guatemala</option>
                        <option value="GY">Guayana</option>
                        <option value="GF">Guayana Francesa</option>
                        <option value="GN">Guinea</option>
                        <option value="GQ">Guinea Ecuatorial</option>
                        <option value="GW">Guinea-Bissau</option>
                        <option value="HT">Haití</option>
                        <option value="HN">Honduras</option>
                        <option value="HU">Hungría</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IQ">Irak</option>
                        <option value="IR">Irán</option>
                        <option value="IE">Irlanda</option>
                        <option value="BV">Isla Bouvet</option>
                        <option value="CX">Isla de Christmas</option>
                        <option value="IS">Islandia</option>
                        <option value="KY">Islas Caimán</option>
                        <option value="CK">Islas Cook</option>
                        <option value="CC">Islas de Cocos o Keeling</option>
                        <option value="FO">Islas Faroe</option>
                        <option value="HM">Islas Heard y McDonald</option>
                        <option value="FK">Islas Malvinas</option>
                        <option value="MP">Islas Marianas del Norte</option>
                        <option value="MH">Islas Marshall</option>
                        <option value="UM">Islas menores de Estados Unidos</option>
                        <option value="PW">Islas Palau</option>
                        <option value="SB">Islas Salomón</option>
                        <option value="SJ">Islas Svalbard y Jan Mayen</option>
                        <option value="TK">Islas Tokelau</option>
                        <option value="TC">Islas Turks y Caicos</option>
                        <option value="VI">Islas Vírgenes (EEUU)</option>
                        <option value="VG">Islas Vírgenes (Reino Unido)</option>
                        <option value="WF">Islas Wallis y Futuna</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italia</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japón</option>
                        <option value="JO">Jordania</option>
                        <option value="KZ">Kazajistán</option>
                        <option value="KE">Kenia</option>
                        <option value="KG">Kirguizistán</option>
                        <option value="KI">Kiribati</option>
                        <option value="KW">Kuwait</option>
                        <option value="LA">Laos</option>
                        <option value="LS">Lesotho</option>
                        <option value="LV">Letonia</option>
                        <option value="LB">Líbano</option>
                        <option value="LR">Liberia</option>
                        <option value="LY">Libia</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lituania</option>
                        <option value="LU">Luxemburgo</option>
                        <option value="MK">Macedonia, Ex-República Yugoslava de</option>
                        <option value="MG">Madagascar</option>
                        <option value="MY">Malasia</option>
                        <option value="MW">Malawi</option>
                        <option value="MV">Maldivas</option>
                        <option value="ML">Malí</option>
                        <option value="MT">Malta</option>
                        <option value="MA">Marruecos</option>
                        <option value="MQ">Martinica</option>
                        <option value="MU">Mauricio</option>
                        <option value="MR">Mauritania</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">México</option>
                        <option value="FM">Micronesia</option>
                        <option value="MD">Moldavia</option>
                        <option value="MC">Mónaco</option>
                        <option value="MN">Mongolia</option>
                        <option value="MS">Montserrat</option>
                        <option value="MZ">Mozambique</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Níger</option>
                        <option value="NG">Nigeria</option>
                        <option value="NU">Niue</option>
                        <option value="NF">Norfolk</option>
                        <option value="NO">Noruega</option>
                        <option value="NC">Nueva Caledonia</option>
                        <option value="NZ">Nueva Zelanda</option>
                        <option value="OM">Omán</option>
                        <option value="NL">Países Bajos</option>
                        <option value="PA">Panamá</option>
                        <option value="PG">Papúa Nueva Guinea</option>
                        <option value="PK">Paquistán</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Perú</option>
                        <option value="PN">Pitcairn</option>
                        <option value="PF">Polinesia Francesa</option>
                        <option value="PL">Polonia</option>
                        <option value="PT">Portugal</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="QA">Qatar</option>
                        <option value="UK">Reino Unido</option>
                        <option value="CF">República Centroafricana</option>
                        <option value="CZ">República Checa</option>
                        <option value="ZA">República de Sudáfrica</option>
                        <option value="DO">República Dominicana</option>
                        <option value="SK">República Eslovaca</option>
                        <option value="RE">Reunión</option>
                        <option value="RW">Ruanda</option>
                        <option value="RO">Rumania</option>
                        <option value="RU">Rusia</option>
                        <option value="EH">Sahara Occidental</option>
                        <option value="KN">Saint Kitts y Nevis</option>
                        <option value="WS">Samoa</option>
                        <option value="AS">Samoa Americana</option>
                        <option value="SM">San Marino</option>
                        <option value="VC">San Vicente y Granadinas</option>
                        <option value="SH">Santa Helena</option>
                        <option value="LC">Santa Lucía</option>
                        <option value="ST">Santo Tomé y Príncipe</option>
                        <option value="SN">Senegal</option>
                        <option value="SC">Seychelles</option>
                        <option value="SL">Sierra Leona</option>
                        <option value="SG">Singapur</option>
                        <option value="SY">Siria</option>
                        <option value="SO">Somalia</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="PM">St Pierre y Miquelon</option>
                        <option value="SZ">Suazilandia</option>
                        <option value="SD">Sudán</option>
                        <option value="SE">Suecia</option>
                        <option value="CH">Suiza</option>
                        <option value="SR">Surinam</option>
                        <option value="TH">Tailandia</option>
                        <option value="TW">Taiwán</option>
                        <option value="TZ">Tanzania</option>
                        <option value="TJ">Tayikistán</option>
                        <option value="TF">Territorios franceses del Sur</option>
                        <option value="TP">Timor Oriental</option>
                        <option value="TG">Togo</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad y Tobago</option>
                        <option value="TN">Túnez</option>
                        <option value="TM">Turkmenistán</option>
                        <option value="TR">Turquía</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UA">Ucrania</option>
                        <option value="UG">Uganda</option>
                        <option value="UY">Uruguay</option>
                        <option value="UZ">Uzbekistán</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VE">Venezuela</option>
                        <option value="VN">Vietnam</option>
                        <option value="YE">Yemen</option>
                        <option value="YU">Yugoslavia</option>
                        <option value="ZM">Zambia</option>
                        <option value="ZW">Zimbabue</option>
                </select>
                </label>
             </div>
               <div class="col-sm-3">
                <label for="pasword" class="col-sm-2 col-form-label">Gender
                   <select name="user_gender">
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </label>
                <?php
                        }
                ?>
             </div>
             
             <div class="col-sm-3">
                  <input type="submit" name ="submit" class="btn btn-primary" value="Sign Up"></button>
              </div>
        </form>
        
    </div>
    
 </div>
     