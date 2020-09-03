<?php
require_once('./helpers/helpers.php');
require_once('./libreries/mercado_pago/vendor/autoload.php');

// SDK de Mercado Pago



//vendedor
//id 638025510
//usuario TETE1344796
//contraseña qatest5120
//email test_user_26895227@testuser.com

//comprador 
//id 638025895
//usuario TESTRCLYN301
//contraseña qatest9215
//email test_user_9125454@testuser.com

       

class SaleController
{
    var $cartModal = "";
    var $menus = "";
    var $objCart = "";

    public function __construct()
    {
       $this->objCart = new CartController();
       

    }



    function Order()
    {
 

        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();  
    
       // Agrega credenciales //vendedor
       MercadoPago\SDK::setAccessToken('TEST-1218582272278192-072519-c5870866aad96a524b3e53fe6a5159e3-190111146');
       // Crea un objeto de preferencia
       $preference = new MercadoPago\Preference();
       
       // Crea un ítem en la preferencia
       $item = new MercadoPago\Item();
       $item->title = 'Mi producto';
       $item->quantity = 1;
       $item->unit_price = 75.56;

       $preference->items = array($item);
       $preference->save();
        

        require_once('views/Order/order.php');
    }


    function Pagar()
    {

    }


//Modal Carrito
function ModalCart()
{
    $cart = $this->objCart->AddCart();
    return $cart;
}

function CartTotal()
{
    $total = $this->objCart->Total();
    return $total;
}

function ModalCantidad()
{
    $cantidad = $this->objCart->Cantidad();
    return $cantidad;
}









}






?>