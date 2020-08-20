<?php
//se llama al modelo
require_once('models/ProductModel.php');

//clase del controlador
class IndexController{

    public function index(){
        //llamo al objeto del modelo
        $product = new ProductModel();
        //llamo la funcion a ejecutar
       // $productos = $product->Allcategories();
        
        //renderiza la vista
        require_once 'views/index.php';
    }



}