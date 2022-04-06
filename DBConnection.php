<?php

class DBConnection {
   
    private $host    = DB_HOST;
    private $user    = DB_USER;
    private $pass    = DB_PASS;
    private $dbname  = DB_NAME;
   
    private $dbh;
   
    private $error = '';

    /* function __construct
     * Abre una nueva conexión a la BBDD
     * @param $config es un array con los parámetros de conexión a la BBDD
     */
    public function __construct() {
        //set dsn
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        //set options
        $options = array(
            PDO::ATTR_PERSISTENT   =>true,
            PDO::ATTR_ERRMODE      => PDO::ERRMODE_EXCEPTION
        );
        //Create a new pdo INSTANCE
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (Exception $e ) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
        return $this->error;
    }
   
    public function __toString() {
        return $this->error;
    }
   
    public function getCon(){
        return $this->dbh;
    }
   
    /* Function __destruct
     * Cierra la conexión con la BBDD
     */
    public function __destruct()     {
        $this->dbh = NULL;
    }
   
    /* Function getPDOConnection
     * Obtener una conexión a la BBDD mediante una instancia de la clase PDO.
     */
    public function getPDOConnection(){
        if ($this->dbh == NULL) {
            //Creamos la conexion. Primero formamos el dsn
            $dsn = "".
                $this->_config['driver'].
                ":host=" . $this->_config['host'] .
                ";dbname=" . $this->_config['dbname'];
            //Hacemos la conexión persistente y activamos el lanzamiento de excepciones
            $options = array(
                PDO::ATTR_PERSISTENT    => true,
                PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
                );
            try {
               
                $this->dbh = new PDO($dsn, $this->_config['username'], $this->_config['password'], $options);
             
            } catch (PDOException $e) {
                echo __LINE__ . $e->getMessage();
            }
        }
    }
   
    /* Function runQuery
     * Ejecuta una consulta de tipo insert, update o delete  
     * @param string sentencia sql con insert update o delete
     * @return int número de tuplas afectadas por la consulta
     */
    public function runQuery($sql)     {
        try {
            $count = $this->dbh->exec($sql) ;
        } catch (PDOException $e) {
            echo __LINE__ . $e->getMessage();
        }
        return $count;
    }
   
    /* Function getQuery
     * Runs a select query
     * @param string sentencia con la consulta sql tipo select
     * @returns array asociativo con las tuplas y campos devueltos por la consulta
     */
    public function getQuery($sql){
        try {
            $stmt = $this->dbh->query($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) 
        {
            echo __LINE__ . $e->getMessage();
        }

        return $stmt;
    }
}
