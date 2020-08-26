<?php
//se llama al modelo
require_once('models/CategorieModel.php');
require_once('models/ProductModel.php');

//clase del controlador
class IndexController{

    //variable global de concatenacion
    var $objCategorie = "";
    var $objProduct = "";

    public function __construct() {
       $this->objCategorie = new CategorieModel;
       $this->objProduct = new ProductModel();

    }

    public function index()
    {
        
        $menus = $this->MainMenu();
        //funcion categorires
        $categories = $this->AllCategoriees();
        //funcion productos
        $products = $this->AllProducts();

        //renderiza la vista
        require_once 'views/index.php';   
    }

    function MainMenu()
    {
        $menus = "";
        $menus .= $this->ModulsMenu();
        return '<ul class="main_menu">'.$menus.'</ul>';
    }

    function ModulsMenu($parent_id=NULL)
    {
        $menu = "";
        $row = array();
        
        if(is_null($parent_id)){
            $sql = "SELECT * FROM `CATEGORIES` WHERE `parent_id` IS NULL";
        $result =  $this->objCategorie->getMenu($sql);
        }else{
            $sql = "SELECT * FROM `CATEGORIES` WHERE `parent_id` = $parent_id";
            $result = $this->objCategorie->getMenu($sql);
        }


        foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
            if($row["parent_id"]){
                $menu .= '<li><a href="#">'.$row['name'].'</a>';
            }else{
                $menu .= '<li><a href="#">'.$row['name'].'</a>';
            }


            $row_id = $row["id_categorie"];
            $sql_b = "SELECT * FROM `CATEGORIES` WHERE `parent_id` = $row_id ";
            $count =  $this->objCategorie->getMenu($sql_b);

            if ($count->rowCount() > 0) {
                $menu .= '<ul class="sub_menu">'.$this->ModulsMenu($row["id_categorie"]).'</ul>';

            }else{
                $menu .= $this->ModulsMenu($row["id_categorie"]);
            }

            $menu .= '</li>';
        }

        return $menu;
    }

    function AllCategoriees(){       
        //llamo la funcion a ejecutar
        $categories = $this->objCategorie->Allcategories();
        //retorno el resultado
        return $categories;
    }

    function AllProducts()
    {
        $products = $this->objProduct->innerProducts();
        return $products;
    }


}