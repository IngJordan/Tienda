<?php


class SucessModel extends crudMysql{




    function Sale($values)
    {
        $request = $this->insert("`SALES`",$values);
        return $request;
    }

    function Sends($values)
    {
        $request = $this->insert("`SENDS`",$values);
       
        return $request;
    }

    function Product_Sale($id_sale)
    {
        $request = 0;

        foreach ($_SESSION['carrito'] as $value):
            $request = $this->insert("`PRODUCTS-SOLD`","null,".$value['COUNT'].",".$value['PRICE'].",".$value['PRICE']*$value['COUNT'].",'".$value['COLOR'].','.$value['SIZES']."',".$value['ID'].",$id_sale");

            $cadena1 = "UPDATE `PRODUCTS` INNER JOIN COLORS INNER JOIN SIZES
            SET COLORS.count = COLORS.count - ".$value['COUNT'].", PRODUCTS.inventorie = PRODUCTS.inventorie - ".$value['COUNT'].", SIZES.count = SIZES.count - ".$value['COUNT']." WHERE COLORS.fk_id_product = ".$value['ID']." and PRODUCTS.id_product = ".$value['ID']." and COLORS.name = '".$value['COLOR']."' and SIZES.name = '".$value['SIZES']."' and SIZES.fk_id_product = ".$value['ID']." ";
            
            $this->update($cadena1);
            
        endforeach;
        
        return $request;
    }


    function Payments($values)
    {
        $request = $this->insert("`PAYMENTS`",$values);
        return $request;
    }








}




?>