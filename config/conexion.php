<?php

//se crea la clase conexion
class conexion{
    
    //se funcion estatica de la conexion
    static function Mysql()
    {
        try {
            //se crea el objeto con la fucnion de pdo
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $conect = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";",DB_USER,DB_PASSWORD,$opciones);
            //establece los atributos
            $conect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //imprime un mensaje si esta conectado
            //echo 'conectado';
            return $conect;
        } catch (PDOException $e) {
            //llama al objeto y le asigna un valor
            $conect = 'Error de conexon';
            //imprime los errores encontrados
            echo "Error: ".$e->getMessage();
        }
        
    }

    //funcion estatica para cerrar conexion a mysql
    static function CloseMysql(&$conn){
        $conn=null;
    }

    
    }
    


?>