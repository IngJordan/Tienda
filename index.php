<?php 
session_start();


//se llaman los archivos globales donde se podran utilizar en todo el proyecto
require_once('./autoload.php');
require_once('./config/routes.php');
require_once('./config/conexion.php');
require_once('./config/crudMysql.php');
require_once('./helpers/helpers.php');



//comprueba si la variables esta definida
if(isset($_GET['controller'])){
    //guarda el nombre y se concatena .controller, se guarda en la variable
    $nombre_controlador = $_GET['controller'].'Controller';
        //comprueba si el controller esta definido y la action
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){

    //llama al controlador por default establecido 
    $nombre_controlador = ControllerDefault;

}else{
    //imprime un mensaje si algo salio mal
    echo 'Error al cargar el controlador';
    exit();
}

//verifica si la clase a sido definida 
if(class_exists($nombre_controlador)){
    //se declara el objeto
    $controlador = new $nombre_controlador();

    //comprueba si la variables esta definida y comprueba si existe un método de una clase
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        //optengo el valor por metodo get y la guardo
        $action = $_GET['action'];
        //hace referencia a un objeto
        $controlador->$action();
        //comprueba si existe controller y action
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        //llama al controlador por default
        $action_default = ActionDefault;
        //hace referencia a un objeto
        $controlador->$action_default();
    }else{
        //manda un error 
        echo 'Error al cargar el controlador';
    }
}else{
    //manda un error
    echo 'Error al cargar el controlador';
}




?>


