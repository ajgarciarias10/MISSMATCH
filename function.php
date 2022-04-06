<?php
class func
{
    //Comprobando el login  para el login persistente
     /**
     * 
     * 
     * @param $con variable que contiene la conexion para poder utilizar los metodos de la clase PDO 
     * 
     */
    
    public static function checkLogin($con) 
    {
      //region caso de que no haya variables de session  
        //1º Comprobamos si hay variables de session 
        //Si no se establece la session
            if(!isset($_SESSION)){
                //Desplegamos errores de las cookies
              ini_set('session.cookie_httponly',1);
              session_start();//Iniciamos una session
            }
            
            //2º Comprobamos que haya COOKIES UMMM
            //Si esta definida la variable user_id   en las cookies 
         
            if (isset($_COOKIE['user_id'])) {
                //Establecemos cada campo que guarda las variables cookies que son el id, el token y el serial
                $user_id = $_COOKIE['user_id'];
                $token = $_COOKIE['token'];
                $serial = $_COOKIE['serial'];
                //Realizamos la consulta de la tabla de sessiones para consultar todas las sessiones con nuestras cookies  el user_id que tiene nuestras cookies el token y el serial
                $sql = "SELECT * FROM sessions WHERE session_userid = :user_id AND session_token = :token AND session_serial = :serial ;";
                //Preparamos la consulta con el metodo prepare de la clase PDO que nos lo da la variable con
                $stmt = $con->prepare($sql);
                //Introducimos en un array asociativo de parametros para que  tenga sentido la utilización de esta sentencia preparada con operadores binarios
                $params = array(":user_id" => $user_id,
                                ":token" => $token,
                                ":serial" => $serial,);
                
                
                //Ejecutamos la consulta     
                $stmt->execute($params);
                //$row generamos una tabla bidimensional utilizando el metodo fetchAll y le metemos  el PDOSTAMEMENT FETCH_ASSOC QUE DEVUELVE EL ARRAY ORDENADO POR LOS NOMBRES DE LA COLUMNA
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //Si al contar las filas se proporciona algun resultado devolvemos verdadero
                //Recuerda para tablas bidimensionales osea utilizando fetchAll() utilizamos count y en el caso de fetch() se utiliza rowCount()
                if (count($row) > 0) {
                  //  func::updateToken($con);
                    return true;
                }else{
                    return false;
                }
            }
        //endregion 
        //2º Caso de que haya variables de session
        elseif (isset($_SESSION['user_id']))
        {
            //Almacenamos en la variables que vamos a utilizar para los operadores binarios las variables de session
            $user_id = $_SESSION['user_id'];
            $token = $_SESSION['token'];
            $serial = $_SESSION['serial'];
            //Realizamos la consulta de la tabla de sessiones para consultar todas las sessiones 
            $query = "SELECT * FROM sessions WHERE session_userid = :user_id AND session_token = :token AND session_serial = :serial";
            //Preparamos la consulta con el metodo prepare de la clase PDO que nos lo da la variable con
            $stmt = $con->prepare($query);
              //Introducimos en un array asociativo de parametros para que  tenga sentido la utilización de esta sentencia preparada con operadores binarios
            $params = array(":user_id" => $user_id,
                            ":token" => $token,
                            ":serial" => $serial,);
                             //Ejecutamos la consulta     
            $stmt->execute($params);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            //Hay login
            if(count($row) > 0){
                return true;
            } else {//No hay login
                return false;
            }
        }
        return false;//En el caso de que no haya ni cookies ni session devolvemos falso
    }
    
    /**
     * 
     * PREPARAR UNA SENTENCIA QUE ME DE EL NOMBRE DEL TOPIC DE UNA CATEGORIA EN CONCRETO
     *  PASANDOLE EL ID DEL USUARIO Y LA CATEGORIA EN LA QUE RECORREMOS
     * SE DEBE SACAR DE LA TABLA SQL: 'mismatch_responses' 
     * @param $catergory_id , $user_id, $con
     * 
     */
    
    public static function getInputsTopics($category_id,$user_id,$con){

       $sql ="SELECT top.topic_id, top.name, res.response from mismatch_topic as top inner join mismatch_response as res USING(topic_id) WHERE category_id= :category_id and user_id = :user_id;";
       $stmt = $con ->prepare($sql);
       //EJECUTAMOS LA SENTENCIA DE ANTES Y LA CONVERTIMOS A UNA TABLA
       $stmt -> execute(array(':category_id'=>$category_id,
                            ':user_id'=>$user_id));
       $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);
       $cadena = " ";
       //RECORREMOS TODOS LOS RESULTADOS
       foreach($rows as $row){
           //GENERAMOS 2 RADIO BUTTONS POR RESULTADO (LOVE y HATE) LOS CUALES A UNO DE ELLOS
            $topic_id = $row['topic_id'];
            $response = $row['response'];
              
            $cadena .= "<div class='form-check form-check-inline'>";
                $cadena .= "<label class='form-check-label'>" . $row['name'] . "</label>";
            $cadena .= "</div>";
            
            $cadena .= "<div class='form-check form-check-inline'>";
            //PUEDE SER QUE LE AGREGUEMOS EL PARAMETRO 'checked' EN EL CASO DE QUE
            //EL CAMPO 'response' DE LA CONSULTA ANTERIOR TENGA ALGO (Significa que el usuario ya ha metido alun valor con anterioridad)
                if($response == 1)
                    $cadena .= "<input class='form-check-input' type='radio' name='" . $topic_id . "' id='" . $topic_id . "-1' value='1' checked>";
                else
                    $cadena .= "<input class='form-check-input' type='radio' name='" . $topic_id . "' id='" . $topic_id . "-1' value='1'>";
                $cadena .= "<label class='form-check-label' for='" . $topic_id . "-1'>LOVE</label>";
            $cadena .= "</div>";
            $cadena .= "<div class='form-check form-check-inline'>";
            //PUEDE SER QUE LE AGREGUEMOS EL PARAMETRO 'checked' EN EL CASO DE QUE
                if($response == 2)
                    $cadena .= "<input class='form-check-input' type='radio' name='" . $topic_id . "' id='" . $topic_id . "-2' value='2' checked>";
                else
                    $cadena .= "<input class='form-check-input' type='radio' name='" . $topic_id . "' id='" . $topic_id . "-2' value='2'>";
                $cadena .= "<label class='form-check-label' for='" . $topic_id . "-2'>HATE</label>";
            $cadena .= "</div>";
            $cadena .= "<br>";
       }
       
       return $cadena;
    }
    
    
    //Actualizamos el token
    private static function updateToken($con){
        $token = func::createSerial(30);
        if(isset($_COOKIE['token']))
        setcookie('token', $token);
        $sql = "UPDATE sessions SET session_token = :token WHERE session_userid = :userid";
        $stmt = $con->prepare($sql);
        $stmt->execute(array('token'=>$token, 'userid'=>$_COOKIE['user_id']));
    }
    
    //1er paso Guardar la sesion
    public static function recordSession($con, $user_id, $username, $rememberMe)
    {
        $sql = "Delete from sessions where session_userid = :session_id";
        $stmt = $con->prepare($sql);
        $stmt->execute([":session_id" => $user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $token = func::createSerial(30);
        $serial = func::createSerial(30);
        
        if ($rememberMe == 1) {
            func::createCookies($user_id, $username, $token, $serial);
        }
        func::createSession($user_id, $username, $token, $serial);
        
        $d = new DateTime("now");
        $d = $d->format("Y-m-d");
        $sql = "INSERT INTO sessions (session_userid, session_serial, session_token, session_date) VALUES (:userid, :serial, :token, :date)";
        $stmt = $con->prepare($sql);
        //var_dump($stmt . "<br");
        $params = array(':userid'=>$user_id,
                        ':serial'=>$serial,
                        ':token'=>$token,
                        ':date'=>$d);
        $stmt->execute($params);
    }
    
   public static function createCookies($user_id, $username, $token, $serial)
    {
        setcookie("user_id", $user_id, time() + 3000, "/");
        setcookie("username", $username, time() + 3000, "/");
        setcookie("token", $token, time() + 3000, "/");
        setcookie("serial", $serial, time() + 3000, "/");
    }
    
    public static function createSession($user_id, $username, $token, $serial)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['token'] = $token;
        $_SESSION['serial'] = $serial;
    }
    public static function createSerial($length)
    {
        //funcion para que el usuario no pueda introducir un mismo fichero

        $frase =
            "modedQEEQDHETO79Pcevtoybuijkolp13EDR231+ertfyguhijoklwserdtfyguhijoerxtyuiopdefedeffeddADdedeADADBGWFEd31452367awTYKU64532E3RFGREHTExtintorte";
        $serial = "";
        mt_srand(time()); //Semilla
        for ($i = 1; $i <= $length; $i++) {
            $serial .= substr($frase, mt_rand(0, strlen($frase)), 1);
            //(.=)Concatenamos todo y utilizamos substr = Devuelve una parte del string definida por los parámetros start=0 y length=strlen($frase).
        }
        //echo "Serial:" . $serial; //Imprimimos en pantalla
        return $serial;
    }
    function cleanSearchWord($busqueda)
    {
        //funcion para que el usuario no pueda introducir un mismo fichero
        $array = [".", ",", "/", "+", "-", "_", ":", ";", "&"];
        //$array = array('/\./','/\;/','/\,/','/\?/','/\!/','/\-/','/\_/');//Aqui vamos a meter lo que queremos que no este para poder leer bien la busqueda
        $giveBack = str_replace($array, " ", $busqueda);
        $giveBack = explode(" ", $giveBack);
        $giveBack = array_filter($giveBack);
        return $giveBack;
    }
}
?>
