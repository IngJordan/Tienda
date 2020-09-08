<?php


class SucessModel extends crudMysql{




    function Sale($data)
    {
        
        $request = $this->insert("SALES",$data);
        return $request;
    }

    function Product_Sale($data)
    {
        $request = $this->insert1($data);
        return $request;
    }

    function Sends($data)
    {
        $request = $this->insert1($data);
        return $request;
    }

    function Payments($data)
    {
        $request = $this->update($data);
        return $request;
    }







}




?>