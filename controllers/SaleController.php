<?php
require_once('./helpers/helpers.php');

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

        require_once('views/Order/order.php');
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