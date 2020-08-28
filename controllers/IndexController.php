<?php
//se llama al modelo
require_once('models/CategorieModel.php');
require_once('models/ProductModel.php');

//clase del controlador
class IndexController{

    //variable global de concatenacion
    var $objCategorie = "";
    var $objProduct = "";
    var $menus = "";
    var $categories= "";
    var $products = "";

    public function __construct() {
       $this->objCategorie = new CategorieModel;
       $this->objProduct = new ProductModel();

    }

    public function index()
    {
        //funcion del menu
        $this->menus = $this->MainMenu();
        //funcion categorires
        $this->categories = $this->AllCategoriees();
        //funcion productos
        $this->products = $this->AllProducts();

        //renderiza la vista
        require_once 'views/home.php';   
    }

    function MainMenu()
    {
        $menus = "";
        //se concatena el resultado
        $menus .= $this->ModulsMenu();
        //se retorna e resultado completo
        return '<ul class="main_menu">'.$menus.'</ul>';
    }

    //inicializamos la funcion en nulll para que me regrese primero a los padres
    function ModulsMenu($parent_id=NULL)
    {
        //variable para concatenar strings
        $menu = "";
        //variable de array
        $row = array();
        
        //se compara si la variable parend_id es null
        if(is_null($parent_id)){
            //selecciona al padre
            $sql = "SELECT * FROM CATEGORIES  WHERE parent_id IS NULL ORDER BY name ASC";
            //se manda al modelo y retorna el resultado
            $result =  $this->objCategorie->getMenu($sql);
            
        }else{
           
            //selecciona los hijos
            $sql = "SELECT * FROM CATEGORIES  WHERE parent_id = $parent_id ORDER BY name ASC";
            //se manda al modelo y retorna el resultado
            $result = $this->objCategorie->getMenu($sql);
        }

        //devuelve filas
        foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
            //existe un valor en parend_id
            if($row["parent_id"]){
                $menu .= '<li><a href="'.URL_BASE.'product/index&data='.Encrip($row['id_categorie']).'">'.$row['name'].'</a>';
            }else{
                $menu .= '<li><a href="'.URL_BASE.'product/index&data='.Encrip($row['id_categorie']).'">'.$row['name'].'</a>';
            }
            //capturamos el id de la categoria
            $row_id = $row["id_categorie"];
            //realizamos una consulta recursiva para traer a los hijos
            $sql_b = "SELECT * FROM CATEGORIES  WHERE parent_id = $row_id ORDER BY name ASC ";
             //se manda al modelo y retorna el resultado
            $count =  $this->objCategorie->getMenu($sql_b);

            //contamos cuntas filas trajo
            if ($count->rowCount() > 0) {
                //se llama a la funcion ModulsMenu para hacer de nuevo la comparacion si tiene hijo de hijo se agrega el ul
                $menu .= '<ul class="sub_menu">'.$this->ModulsMenu($row["id_categorie"]).'</ul>';

            }else{
                //si no solo agrega a un hijo
                $menu .= $this->ModulsMenu($row["id_categorie"]);
            }

            //se cierra el li
            $menu .= '</li>';
        }

        //se retorna el resultado
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