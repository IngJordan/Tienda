<?php
require_once('./helpers/helpers.php');
// SDK de Mercado Pago
require_once('./libreries/mercado_pago/vendor/autoload.php');

require_once('./models/SuccessModel.php');

/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  */

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

//5031 7557 3453 0604
//11/25
//123
//APRO

class SaleController
{
    var $cartModal = "";
    var $menus = "";
    var $objCart = "";

    

    public function __construct()
    {
       $this->objCart = new CartController();
    }

    function Formulario()
    {
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal(); 


        if(!isset($_SESSION['total-product'])) {
            $_SESSION['total-product'] = array(
                'envio' =>$_POST['envio'],
                'total' =>$_POST['total']
            );
        }else{
            $_SESSION['total-product'] = array(
                'envio' =>$_POST['envio'],
                'total' =>$_POST['total']
            );
        }


        require_once('views/Order/form.php');
    }

    function Registro()
    {

        if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['cp']) && isset($_POST['estado']) && isset($_POST['municipio']) && isset($_POST['colonia']) && isset($_POST['ext']) && isset($_POST['int']) && isset($_POST['calle1']) && isset($_POST['calle2']) && isset($_POST['radio']) && isset($_POST['telefono']) && isset($_POST['referencia'])) {
           
        }else{

            $_SESSION['form-envio'] = array(
                'name' =>$_POST['nombre'],
                'cp' =>$_POST['cp'],
                'estado' =>$_POST['estado'],
                'municipio' =>$_POST['municipio'],
                'colonia' =>$_POST['colonia'],
                'ext' =>$_POST['ext'],
                'int' =>$_POST['int'],
                'calle1' =>$_POST['calle1'],
                'calle2' =>$_POST['calle2'],
                'radio' =>$_POST['radio'],
                'telefono' =>$_POST['telefono'],
                'referencias' =>$_POST['referencias']
            );

            header ("Location: ".URL_BASE."Sale/Pago");
        }
    }

    function Pago()
    {
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();

        // Agrega credenciales //vendedor
        MercadoPago\SDK::setAccessToken('TEST-6674804345396962-090319-656db01b6de286e8bd3251f0525af531-638025510');
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        $preference->back_urls = array(
            "success" => URL_BASE."Sale/Success",
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "http://www.tu-sitio/pending"
        );
        
        $datos = array();

        foreach ($_SESSION['carrito'] as $index => $value) {
            // Crea un ítem en la preferencia
            $item = new MercadoPago\Item();
            $item->title = $value['NAME'];
            $item->description = $value['DESCRIPTION'].' '.$value['SIZES'].' '.$value['COLOR'];
            $item->quantity = $value['COUNT'];
            $item->unit_price = $value['PRICE'];
            $datos[] = $item;
        }

        $shipments = new MercadoPago\Shipments();
     
        $shipments->cost = (int) $_SESSION['total-product']['envio'];
        
        $preference->items = $datos;
        $preference->shipments = $shipments;
    
        $preference->save();

        require_once('./views/Order/payment.php');
    }

    function Success()
    {
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal(); 











        require_once('./views/Order/success.php');
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