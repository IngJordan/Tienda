<?php


class crudMysql extends conexion{
    //creacion de variables privadas
    private $conexion;
    private $table;
    private $data;
    private $select;
    private $inner;
    private $condicion;

    //funcion contructor para que se ejecute primero
    function __construct()
    {
        $this->conexion = conexion::Mysql();
    }

    //funcion insert
    public function insert(string $table,string $data){
        //hacemos referencia a la variable
        $this->table = $table;
        $this->data = $data;
        //preparamos la consulta y resivimos los valores
        $insert = $this->conexion->prepare("INSERT INTO ".$this->table." VALUES (".$this->data.")");
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

    public function insert1(string $table){
        //hacemos referencia a la variable
        $this->table = $table;

        //preparamos la consulta y resivimos los valores
        $insert = $this->conexion->prepare($table);
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
        $consul="SELECT * FROM ".$this->table." WHERE ".$this->condicion;
        $selectOne = $this->conexion->prepare($consul);
        $selectOne->execute();
        $result = $selectOne->fetchAll(PDO::FETCH_ASSOC);
        return $result;
            
    } 

    //funcion que devuelve todos los datos
    public function selectAll(string $table, string $condicion){
        $this->table = $table;
        $this->condicion = $condicion;
        $selectAll = $this->conexion->prepare("SELECT * FROM ".$this->table." ".$this->condicion);
        $selectAll->execute();
        $result = $selectAll->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //funcion de actualizar
    public function update(string $data){
        //$this->table = $table;
        $this->data = $data;
        //$this->condicion = $condicion;
        $update = $this->conexion->prepare($data);
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

    //funcion de conslta de inner join 
    public function innerJoin(string $select,string $table,string $inner,string $condicion){
        $this->select = $select;
        $this->table = $table;
        $this->inner = $inner;
        $this->condicion = $condicion;
        $sql = $this->select.$this->table.$this->inner.$this->condicion;
        $selectAll = $this->conexion->prepare($sql);
        $selectAll->execute();
        $result = $selectAll->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


        //funcion del menu
        public function Menu($sql){
            $selectOne = $this->conexion->prepare($sql);
            $selectOne->execute();
            return $selectOne;
        } 

 

    
    
    

}

?>