
<?php

class GeneralsModel extends crudMysql{



    function getSlider()
    {
       $request = $this->innerJoin("SELECT CONFIGS.name,CONFIGS.description, IMAGES.route FROM ","`CONFIGS` "," INNER JOIN IMAGES"," WHERE IMAGES.name = 'slider'");
       return $request;
    }





}




?>