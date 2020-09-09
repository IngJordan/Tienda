<?php 
session_start();

require_once('models/ProductModel.php');

class CartController{
    
    var $menus = "";

    function AddCart()
    {
        if (isset($_POST['id']) && isset($_POST['sizes']) && isset($_POST['color']) && isset($_POST['num-product']) && is_numeric($_POST['num-product'])) {
           
            $id = $_POST['id'];
            $sizes = $_POST['sizes'];
            $color = $_POST['color'];
            $cantidad = $_POST['num-product'];

          
            $obj = new ProductModel();
            $product = $obj->getOneProduct1($id,$sizes,$color);

            if (!$product)
                echo 'No existe el producto';

            if (isset($_SESSION['carrito'])) {
                
               if (array_key_exists($id.','.$sizes.','.$color,$_SESSION['carrito'])) {

                if (empty($cantidad) && !is_numeric($cantidad)) {
                    header("Location:".URL_BASE."cart/DetailCart");
                }else{
                    $this->Update($id,$sizes,$color,$cantidad);
                    header("Location:".URL_BASE."cart/DetailCart");
                }

               }else{
                $this->Add($product,$id,$sizes,$color,$cantidad);
                header("Location:".URL_BASE."cart/DetailCart");  
               }

            }else{
                $this->Add($product,$id,$sizes,$color,$cantidad);
                header("Location:".URL_BASE."cart/DetailCart");
            }

           /*  depurarArray($_SESSION['carrito']);
            die; */
        }      
     
    }

    function Add($resultado,$id,$sizes,$color,$cantidad = 1)
    {

        foreach ($resultado as $item) {


            if ($item['discount'] == 0) {

                $_SESSION['carrito'][$id.','.$sizes.','.$color] = array(
                    'ID' =>$item['id_product'],
                    'NAME' =>$item['name'],
                    'DESCRIPTION' =>$item['description'],
                    'PRICE' =>$item['price'],
                    'INVENTORIE' =>$item['inventorie'],
                    'DISCOUNT' =>$item['discount'],
                    'SIZES' =>$item['tamaño'],
                    'COLOR' =>$item['color'],
                    'IMG' =>$item['route'],
                    'COUNT' => $cantidad
                );
            }else{

                $decial   = $item['discount'] / 100;
                $descount = $item['price'] * $decial;
                $newtotal = $item['price'] - $descount;

                $_SESSION['carrito'][$id.','.$sizes.','.$color] = array(
                    'ID' =>$item['id_product'],
                    'NAME' =>$item['name'],
                    'DESCRIPTION' =>$item['description'],
                    'PRICE' => $newtotal,
                    'INVENTORIE' =>$item['inventorie'],
                    'DISCOUNT' =>$item['discount'],
                    'SIZES' =>$item['tamaño'],
                    'COLOR' =>$item['color'],
                    'IMG' =>$item['route'],
                    'COUNT' => $cantidad
                );


            }

            
            
        }

    }

    function Update($id,$sizes,$color,$cantidad = FALSE)
    {
       if ($cantidad) {

        if ($cantidad >= $_SESSION['carrito'][$id.','.$sizes.','.$color]['COUNT']) {

            $_SESSION['carrito'][$id.','.$sizes.','.$color]['COUNT'] += $cantidad;
        }else{

            $_SESSION['carrito'][$id.','.$sizes.','.$color]['COUNT'] -= $cantidad;
        }
       }else {
         $_SESSION['carrito'][$id.','.$sizes.','.$color]['COUNT']+=1;
       }
    }

    function Descriment()
    {
      
        if ( !isset($_GET['id']) && !isset($_GET['sizes']) && !isset($_GET['color']) ) 
            header("Location:".URL_BASE);

            $id = $_GET['id'];
            $sizes = $_GET['sizes'];
            $color = $_GET['color'];

            if ($_SESSION['carrito']){

                $_SESSION['carrito'][$id.','.$sizes.','.$color]['COUNT']-=1;
                header("Location:".URL_BASE."cart/DetailCart");

            }else{
                header("Location:".URL_BASE);
            }
    }

    function Aument()
    {
      
        if (!isset($_GET['id']) && !isset($_GET['sizes']) && !isset($_GET['color']) ) 
            header("Location:".URL_BASE);

            $id = $_GET['id'];
            $sizes = $_GET['sizes'];
            $color = $_GET['color'];

            if ($_SESSION['carrito']){

                $_SESSION['carrito'][$id.','.$sizes.','.$color]['COUNT']+=1;
                header("Location:".URL_BASE."cart/DetailCart");

            }else{
                header("Location:".URL_BASE);
            }
    }

    function Total()
    {
        $total = 0;
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $indice => $value) {
                $total += $value['PRICE'] * $value['COUNT']; 
            }
        }

        return $total;
        
    }

    function Cantidad()
    {
        $cantidad = 0;
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $indice => $value) {
                $cantidad ++; 
            }
        }
        return $cantidad;
        
    }

    function DetailCart()
    {
        $this->menus = MainMenu();
        $this->AddCart();
        $totalProduct = $this->Total();
        $cantidad = $this->Cantidad();

        require_once('views/Cart/detailCart.php');
    }

    function DeleteCart()
    {

        if (!isset($_GET['id']) && !isset($_GET['sizes']) && !isset($_GET['color']))
            header("Location:".URL_BASE."cart/DetailCart");

            $id = $_GET['id'];
            $sizes = $_GET['sizes'];
            $color = $_GET['color'];

             if (isset($_SESSION['carrito'])) {
                unset($_SESSION['carrito'][$id.','.$sizes.','.$color]);
                header("Location:".URL_BASE."cart/DetailCart");
     
            }else{
               header("Location:".URL_BASE);
            }
                  
    }

    
}



?>