<?php 

function Index()
{
    $index = header('Location: http://localhost:8888/Tienda/');
    return $index;
}

function MainMenu(){
    $obj = new IndexController();
    $menus = $obj->MainMenu();
    return $menus;
}
 /*
function Cartview(){
   $obj = new CartController();
    $cart = $obj->AddCart();
    return $cart;
   
}
 */

//formato de precios
function formatMoney(int $preice){
    $num =PRICE.number_format($preice)." ".MONEY;
    return $num;
}

//formatea el array 
function depurarArray($data){
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}

function Encrip($data){
    $encript = base64_encode($data);
    return $encript;
}

function Descript($data)
{
    $encript = base64_decode($data);
    return $encript;
}

?>