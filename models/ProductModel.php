<?php

//clase que extiende del crudMysql
class ProductModel extends crudMysql{

    public function innerProducts(){
        $select="SELECT PRODUCTS.id_product,PRODUCTS.name as prodduct_name,PRODUCTS.description,PRODUCTS.price as product_price,PRODUCTS.discount
        ,IMAGES.name as name_imagen,IMAGES.route as route_image,CATEGORIES.name as name_categori,STATUS.description FROM";
        $table = " PRODUCTS";
        $inner = " INNER JOIN CATEGORIES ON PRODUCTS.fk_id_categorie = CATEGORIES.id_categorie
        INNER JOIN STATUS ON PRODUCTS.fk_id_status = STATUS.id_statu
        INNER JOIN IMAGES ON IMAGES.fk_id_product = PRODUCTS.id_product";
        $condicion = " WHERE IMAGES.name='principal' AND inventorie > 0 ORDER BY RAND() LIMIT 20;";
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
        $condicion = " WHERE IMAGES.name='principal' AND CATEGORIES.name = '$condificon' AND inventorie > 0 ORDER BY RAND() LIMIT 20;";
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
    function getOneProduct1($id,$sizes,$color)
    {
        $select="SELECT PRODUCTS.id_product,PRODUCTS.name,PRODUCTS.description,PRODUCTS.price,PRODUCTS.inventorie,PRODUCTS.discount,IMAGES.route,
        SIZES.name AS tamaño ,COLORS.name AS color ,COLORS.count AS c_count,SIZES.count AS s_count FROM";
        $table = " `PRODUCTS`";
        $inner = " INNER JOIN IMAGES
        ON PRODUCTS.id_product = IMAGES.fk_id_product
        INNER JOIN SIZES
        ON PRODUCTS.id_product = SIZES.fk_id_product
        INNER JOIN COLORS
        ON PRODUCTS.id_product = COLORS.fk_id_product";
        $condicion = " WHERE IMAGES.name = 'principal' AND PRODUCTS.id_product = $id AND SIZES.name = '".$sizes."' AND COLORS.name = '".$color."'  AND inventorie > 0";
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
        $select="SELECT SIZES.name, SIZES.count  FROM";
        $table = " `PRODUCTS`";
        $inner = " INNER JOIN SIZES ON PRODUCTS.id_product = SIZES.fk_id_product";
        $condicion = " WHERE PRODUCTS.id_product = $id ";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }

    function getColor($id = 0)
    {
        $select="SELECT COLORS.name,COLORS.codigo , COLORS.count FROM";
        $table = " `PRODUCTS`";
        $inner = " INNER JOIN COLORS ON PRODUCTS.id_product = COLORS.fk_id_product";
        $condicion = " WHERE PRODUCTS.id_product = $id ORDER BY COLORS.name ASC";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }


    function getProduct($id = 0,$limit = 0)
    {
        $select="SELECT PRODUCTS.id_product,PRODUCTS.name,PRODUCTS.description,PRODUCTS.price,IMAGES.route AS url_image,PRODUCTS.discount,STATUS.description FROM";
        $table = " `PRODUCTS`";
        $inner = " INNER JOIN CATEGORIES ON PRODUCTS.fk_id_categorie = CATEGORIES.id_categorie INNER JOIN IMAGES ON PRODUCTS.id_product = IMAGES.fk_id_product
        INNER JOIN STATUS ON PRODUCTS.fk_id_status = STATUS.id_statu";
        $condicion = " WHERE IMAGES.name = 'principal' AND PRODUCTS.fk_id_categorie = $id AND inventorie > 0 ORDER BY RAND() LIMIT $limit;";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }

    function Ofert()
    {
        $select="SELECT PRODUCTS.id_product,PRODUCTS.name as prodduct_name,PRODUCTS.description,PRODUCTS.price as product_price,PRODUCTS.discount
        ,IMAGES.name as name_imagen,IMAGES.route as route_image,CATEGORIES.name as name_categori,STATUS.description FROM";
        $table = " PRODUCTS";
        $inner = " INNER JOIN CATEGORIES ON PRODUCTS.fk_id_categorie = CATEGORIES.id_categorie
        INNER JOIN STATUS ON PRODUCTS.fk_id_status = STATUS.id_statu
        INNER JOIN IMAGES ON IMAGES.fk_id_product = PRODUCTS.id_product";
        $condicion = " WHERE IMAGES.name='principal' AND fk_id_status = 2 AND inventorie > 0 ORDER BY RAND() LIMIT 20;";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }

    function sold_product()
    {
        /* $select="SELECT `PRODUCTS-SOLD`.`id_sold`, SUM(`PRODUCTS-SOLD`.`count`) AS TotalVentas FROM";
        $table = " `PRODUCTS-SOLD` ";
        $inner = " INNER JOIN PRODUCTS ON
        PRODUCTS.id_product = `PRODUCTS-SOLD`.`fk_id_product`
        GROUP BY `PRODUCTS-SOLD`.`id_sold`
        ORDER BY SUM(`PRODUCTS-SOLD`.`count`) DESC
        LIMIT 0 , 30";
        $condicion = "";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request; */
    }


    function verific($carrito)
    {

        $datos = array();


        foreach ($carrito as $value) {
            $request = $this->selectAll("`PRODUCTS`"," WHERE inventorie > 0 and id_product =".$value['ID']."");

            foreach ($request as $item) {
                $item['inventorie'];
                $datos[] = $item;
            }
            
        }

       return $datos;
    }








}

?>