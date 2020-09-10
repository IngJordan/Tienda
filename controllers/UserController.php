<?php 
require_once('./helpers/helpers.php');
require_once('./models/UserModel.php');


class UserController{

    var $cartModal = "";
    var $menus = "";
    var $objCart = "";
    var $objUser = "";


    public function __construct()
    {
       $this->objCart = new CartController();
       $this->objUser = new UserModel();

    }

    function Login()
    {
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();

        require_once('./views/User/login.php');
    }
    

    function Myorder(){
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();

        $listOrder = $this->objUser->getListOrder(1);

       
        require_once('./views/User/my_order.php');
    }


    function DetailOrder()
    {
        if (isset($_GET['data'])):
            $this->menus = MainMenu();
            $this->cartModal = $this->ModalCart();
            $cantidad = $this->cartModal = $this->ModalCantidad();
            $totalProduct = $this->cartModal = $this->CartTotal();
            $id_sale = Descript($_GET['data']);

            $listPorduct = $this->objUser->getProductSale(1,$id_sale);
            
            require_once('./views/User/detail_sale.php');

        else:
            header('Location: '.URL_BASE);
        endif;

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