<?php

require_once('./helpers/helpers.php');
require_once('./models/ProductModel.php');

class ProductController{

    var $ModelProduct = "";
    var $menus = "";
    var $oneProduct = "";
    var $images = "";
    var $sizes = "";
    var $colors = "";
    var $products = "";
    var $commets = "";
    var $objCart = "";

    public function __construct()
    {
       $this->ModelProduct = new ProductModel();
       $this->objCart = new CartController();

    }

    function index()
    {        
       if (isset($_GET['data'])) {
           $id = Descript($_GET['data']);
           $_SESSION['ID_PRODUCT'] = $id;
           
           try {
            $this->menus = MainMenu();
            $this->products = $this->ModelProduct->getProduct($_SESSION['ID_PRODUCT'],2);
            $this->cartModal = $this->ModalCart();
            $cantidad = $this->cartModal = $this->ModalCantidad();
            $totalProduct = $this->cartModal = $this->CartTotal();
            require_once('views/Product/product.php');
            unset($_SESSION['LIMIT']);
           } catch (Exception $e) {
            Index();
           }
       }else{
            $_SESSION['LIMIT'] += 2;
            $_SESSION['LIMIT'] += Descript($_GET['limit']);
            $this->menus = MainMenu();
            $this->products = $this->ModelProduct->getProduct($_SESSION['ID_PRODUCT'],$_SESSION['LIMIT']);
            $this->cartModal = $this->ModalCart();
            $cantidad = $this->cartModal = $this->ModalCantidad();
            $totalProduct = $this->cartModal = $this->CartTotal();

            require_once('views/Product/product.php');
       }
    }

    function DetailProduct()
    {
        
        if (isset($_GET['data'])) {
            $id = Descript($_GET['data']);
           
            try {
                
                $this->menus = MainMenu();
                $this->oneProduct = $this->ModelProduct->getOneProduct($id);
                $this->images = $this->ModelProduct->getImagesProduct($id);
                $this->sizes = $this->ModelProduct->getSizes($id);
                $this->colors = $this->ModelProduct->getColor($id);
                $this->commets = "product/DetailProduct&data=".$id;

                $this->cartModal = $this->ModalCart();
                $cantidad = $this->cartModal = $this->ModalCantidad();
                $totalProduct = $this->cartModal = $this->CartTotal();
                require_once('views/Product/detail_product.php');

            } catch (Exception $e) {
                $this->menus = MainMenu();
                require_once('views/Error/Error.php');
            }
        }

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