<?php

//clase que extiende del crudMysql
class CategorieModel extends crudMysql{

    public function getMenu($sql)
    {
        $request = $this->Menu($sql);
        return $request;
    }
   
    public function Allcategories()
    {
        $select="SELECT CATEGORIES.id_categorie,CATEGORIES.name,IMAGES.route FROM";
        $table = " CATEGORIES";
        $inner = " INNER JOIN IMAGES ON CATEGORIES.id_categorie = IMAGES.fk_id_categorie";
        $condicion = " WHERE IMAGES.name = 'principal' ORDER BY name ASC;";
        $request = $this->innerJoin($select,$table,$inner,$condicion);
        return $request;
    }
    
}



?>