<?php


class crudMysql extends conexion{
    //creacion de variables privadas
    private $conexion;
    private $table;
    private $data;
    private $condicion;

    //funcion contructor para que se ejecute primero
    function __construct()
    {
        $this->conexion = conexion::Mysql();
    }

    //funcion insert
    public function insert(string $table, array $data){
        //hacemos referencia a la variable
        $this->table = $table;
        $this->data = $data;
        //preparamos la consulta y resivimos los valores
        $insert = $this->conexion->prepare("INSERT INTO".$this->table."VALUES(Null,".$this->data.");");
        //ejecutamos la consulta
        $resInsert = $insert->execute();
        //valida si es true
        if ($resInsert) {
            //optengo el ultimo id regstrado
            $lastInsert = $this->conexion->lastInsertId();
        }else{
            //se inicializa en 0 si algo falla
            $lastInsert=0;
        }
        //retorno el valor
        return $lastInsert;
    }

    //funcion de devuelve un dato
    public function selectOne(string $table,string $condicion){
        $this->table = $table;
        $this->condicion = $condicion;
        $consul="SELECT * FROM ".$table." where ".$condicion.";";
        $selectOne = $this->conexion->prepare($consul);
        $selectOne->execute();
        $result = $selectOne->fetch(PDO::FETCH_ASSOC);
        return $result;
            
        } 

    //funcion que devuelve todos los datos
    public function selectAll(string $table){
        $this->table = $table;
        $selectAll = $this->conexion->prepare("SELECT * FROM ".$this->table.";");
        $selectAll->execute();
        $result = $selectAll->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //funcion de actualizar
    public function update(string $table, array $data,string $condicion){
        $this->table = $table;
        $this->data = $data;
        $this->condicion = $condicion;
        $update = $this->conexion->prepare("UPDATE ".$this->table." SET ".$this->data." WHERE ".$this->condicion);
        $result = $update->execute();
        return $result;
    }

    //funcion de eliminar
    public function delete(string $table,string $condicion){
        $this->table = $table;
        $this->condicion = $condicion;
        $result =$this->conexion->prepare("DELETE FROM ".$table." WHERE ".$condicion);
        $result->execute();
        return $result;
    }   

}

?>