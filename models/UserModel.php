<?php 

class UserModel extends crudMysql{



    function getListOrder($id_user)
    {
        $select = "SELECT  SALES.id_sale,SALES.total,SALES.date,STATUS.name FROM";
        $table = " `SALES` ";
        $inner = " INNER JOIN PAYMENTS ON SALES.id_sale = PAYMENTS.fk_id_sale INNER JOIN STATUS ON STATUS.id_statu = PAYMENTS.fk_id_status";
        $condicion = " WHERE SALES.fk_id_user = $id_user ORDER BY SALES.id_sale DESC";

        $request = $this->innerJoin($select,$table,$inner,$condicion);

        return $request;
    }

    function getProductSale($id_user,$id_sale)
    {
        $select = "SELECT IMAGES.route,PRODUCTS.name,SOLD.characteristic,SOLD.price,SOLD.count,SOLD.total FROM";
        $table = " `SALES` ";
        $inner = " INNER JOIN `PRODUCTS-SOLD` AS SOLD ON SALES.id_sale = SOLD.fk_id_sale INNER JOIN PRODUCTS ON SOLD.fk_id_product = PRODUCTS.id_product INNER JOIN IMAGES ON IMAGES.fk_id_product = PRODUCTS.id_product ";
        $condicion = " WHERE SALES.fk_id_user = $id_user AND SOLD.fk_id_sale = $id_sale AND IMAGES.name = 'principal' ";

        $request = $this->innerJoin($select,$table,$inner,$condicion);

        return $request;
    }

      
    /*  FROM SALES 

 */


}


?>