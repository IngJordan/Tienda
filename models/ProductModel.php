<?php

//clase que extiende del crudMysql
class ProductModel extends crudMysql{

    public function innerProducts(){
        $select="SELECT PRODUCTS.id_product,PRODUCTS.name as prodduct_name,PRODUCTS.description,PRODUCTS.price as product_price,PRODUCTS.discount,PRODUCTS.fk_id_status,
        STATUS.name,STATUS.description,IMAGES.name as name_imagen,IMAGES.route as route_image,CATEGORIES.name as name_categori FROM";
        $table = " PRODUCTS";
        $inner = " INNER JOIN CATEGORIES ON PRODUCTS.fk_id_categorie = CATEGORIES.id_categorie
        INNER JOIN STATUS ON PRODUCTS.fk_id_status = STATUS.id_statu
        INNER JOIN IMAGES ON IMAGES.fk_id_product = PRODUCTS.id_product";
        $condicion = " WHERE IMAGES.name='principal' ORDER BY RAND() LIMIT 20;";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }

    public function innerProCategorie(string $condificon)
    {
        $select="SELECT PRODUCTS.id_product,PRODUCTS.name,PRODUCTS.description,PRODUCTS.price,PRODUCTS.discount,PRODUCTS.fk_id_status,
        STATUS.name,STATUS.description,IMAGES.name as name_imagen,IMAGES.route as imagen,CATEGORIES.name as name_categori FROM";
        $table = " PRODUCTS";
        $inner = " INNER JOIN CATEGORIES ON PRODUCTS.fk_id_categorie = CATEGORIES.id_categorie
        INNER JOIN STATUS ON PRODUCTS.fk_id_status = STATUS.id_statu
        INNER JOIN IMAGES ON IMAGES.fk_id_product = PRODUCTS.id_product";
        $condicion = " WHERE IMAGES.name='principal' AND CATEGORIES.name = '$condificon' ORDER BY RAND() LIMIT 20;";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }
}

?>