<?php 

//inicializador de la pagina principal
function Index()
{
    $index = header('Location: http://localhost:8888/Tienda/');
    return $index;
}

//muestra los errores de la pagina
function ViewError()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);  
}

//inicaliza el menu global de la pagina
function MainMenu(){
    $obj = new IndexController();
    $menus = $obj->MainMenu();
    return $menus;
}

//formato de precios
function formatMoney(int $precie){
    $num =PRICE.number_format($precie)." ".MONEY;
    return $num;
}

//formatea el array 
function depurarArray($data){
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}

//encriptacion 
function Encrip($data){
    $encript = base64_encode($data);
    return $encript;
}

//descriptacion
function Descript($data)
{
    $encript = base64_decode($data);
    return $encript;
}

function CleanString($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = str_ireplace("<script>","",$string);
    $string = str_ireplace("</script>","",$string);
    $string = str_ireplace("<script src","",$string);
    $string = str_ireplace("<script type=","",$string);
    $string = str_ireplace("SELECT * FROM","",$string);
    $string = str_ireplace("DELETE FROM","",$string);
    $string = str_ireplace("INSERT INTO","",$string);
    $string = str_ireplace("--","",$string);
    $string = str_ireplace("^","",$string);
    $string = str_ireplace("[","",$string);
    $string = str_ireplace("]","",$string);
    $string = str_ireplace("==","",$string);
    $string = str_ireplace("?","",$string);
    $string = str_ireplace("¿","",$string);
    $string = str_ireplace('"()"',"",$string);
    $string = str_ireplace("/","",$string);
    $string = str_ireplace("'\'","",$string);
    $string = str_ireplace("?","",$string);
    $string = str_ireplace("<","",$string);
    $string = str_ireplace(">","",$string);
    $string = str_ireplace("=","",$string);

    return $string;
}

?>