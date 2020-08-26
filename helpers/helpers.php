<?php 

//formato de precios
function formatMoney(int $preice){
    $num =PRICE.number_format($preice,2,PUNT,COM)." ".MONEY;
    return $num;
}

//formatea el array 
function depurarArray($data){
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}





?>