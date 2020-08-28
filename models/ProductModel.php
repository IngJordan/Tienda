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

    function getOneProduct($id = 0)
    {
        $select="SELECT * FROM";
        $table = " `PRODUCTS`";
        $inner = "";
        $condicion = " WHERE id_product = $id";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }

    function getImagesProduct($id = 0)
    {
        $select="SELECT IMAGES.route AS url_image FROM";
        $table = " `PRODUCTS`";
        $inner = " INNER JOIN IMAGES ON PRODUCTS.id_product = IMAGES.fk_id_product";
        $condicion = " WHERE PRODUCTS.id_product = $id ORDER BY IMAGES.name = 'secundaria'";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }

    function getSizes($id = 0)
    {
        $select="SELECT SIZES.name FROM";
        $table = " `PRODUCTS`";
        $inner = " INNER JOIN SIZES ON PRODUCTS.id_product = SIZES.fk_id_product";
        $condicion = " WHERE PRODUCTS.id_product = $id ";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }

    function getColor($id = 0)
    {
        $select="SELECT COLORS.name,COLORS.codigo FROM";
        $table = " `PRODUCTS`";
        $inner = " INNER JOIN COLORS ON PRODUCTS.id_product = COLORS.fk_id_product";
        $condicion = " WHERE PRODUCTS.id_product = $id ORDER BY COLORS.name ASC";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }


    function getProduct($id = 0)
    {
        $select="SELECT PRODUCTS.id_product,PRODUCTS.name,PRODUCTS.description,PRODUCTS.price,IMAGES.route AS url_image FROM";
        $table = " `PRODUCTS`";
        $inner = " INNER JOIN CATEGORIES ON PRODUCTS.fk_id_categorie = CATEGORIES.id_categorie INNER JOIN IMAGES ON PRODUCTS.id_product = IMAGES.fk_id_product";
        $condicion = " WHERE IMAGES.name = 'principal' AND PRODUCTS.fk_id_categorie = $id ORDER BY RAND() LIMIT 20;";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }



}

?>