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

    public function __construct()
    {
       $this->ModelProduct = new ProductModel();
    }

    function index()
    {        
       if (isset($_GET['data'])) {
           $id = Descript($_GET['data']);
           
           try {
            $this->menus = MainMenu();
            $this->products = $this->ModelProduct->getProduct($id);
            
            require_once('views/Product/product.php');
           } catch (Exception $e) {
            Index();
           }
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

                require_once('views/Product/detail_product.php');

            } catch (Exception $e) {
                $this->menus = MainMenu();
                require_once('views/Error/Error.php');
            }
        }

    }









}



?>