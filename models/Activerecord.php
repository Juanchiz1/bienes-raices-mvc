<?php
namespace Model;

class Activerecord{
 
    protected static $db;

    protected static $columnasDB=[];

    protected static $tabla='';

//Errores
protected static $errores=[];




    public static function setDB($database){
        self::$db=$database;
    }

   public function guardar(){
        if(!is_null($this->id)){
            //Actualizar
            $this->actualizar();
        } else {
            //Crear
            $this->crear();
        }
    } 

  public function actualizar() {
    // Sanitizar los datos
    $atributos = $this->sanitizarDatos();
    
    $valores = [];
    foreach($atributos as $key => $value) {
        $valores[] = "{$key}='{$value}'";
    }
    
    $query = "UPDATE " . static::$tabla . " SET ";
    $query .= join(', ', $valores);
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
    $query .= " LIMIT 1";
    
    $resultado = self::$db->query($query);
    
    if($resultado) {
        header('Location:/admin?resultado=2');
    }
}

   public function crear() {
    // Sanitizar los datos
    $atributos = $this->sanitizarDatos();
    
    // Obtener las columnas y valores
    $columnas = join(', ', array_keys($atributos));
    $valores = "'" . join("', '", array_values($atributos)) . "'";
    
    // Construir la consulta SQL
    $query = "INSERT INTO " . static::$tabla . " ({$columnas}) VALUES ({$valores})";
    
    // Debug: ver la consulta (opcional)
    
    
    // Ejecutar la consulta
    $resultado = self::$db->query($query);
    
    // Debug: ver el resultado (opcional)

    if($resultado) {
    //Redireccionar al usuario
    header('Location:/admin?resultado=1');
} else {
    echo "Error al Insertar";
   
}
    
 
}

public function eliminar(){
    $query="DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $resultado=self::$db->query($query);
    if($resultado){
        $this->borrarImagen();
        header('Location:/admin?resultado=3');
    }
}


    //Identificar y unir los atributos de la bd
    public function atributos(){
        $atributos=[];

        foreach(static::$columnasDB as $columna){
            if($columna ==='id') continue;
            $atributos[$columna]=$this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos=$this->atributos();
        $sanitizado=[];

        foreach($atributos as $key=>$value){
            $sanitizado[$key]=self::$db->escape_string($value);


        }
        return $sanitizado;


    }

    //Validación
    public static function getErrores(){
        
        return static::$errores;
    }

    public function validar(){
        static::$errores=[];
        return static::$errores;
    }

    

    public function setImagen($imagen){

        if(is_null($this->id) && $this->imagen){
            $existearchivo=file_exists(CARPETA_IMAGENES.$this->imagen);
            if($existearchivo){
                unlink(CARPETA_IMAGENES.$this->imagen);
            }
        }
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen=$imagen;
        }
    }

    //elimina el archivo
    public function borrarImagen(){
        $existearchivo=file_exists(CARPETA_IMAGENES.$this->imagen);
        if($existearchivo){
            unlink(CARPETA_IMAGENES.$this->imagen);
        }
    }

    //lista todas las propiedades
    public static function all(){
        $query="SELECT * FROM ".static::$tabla;
        $resultado=self::consultarSQL($query);

       return $resultado;
    }

    //Busca una propiedad por su id
    public static function find($id){
        $query="SELECT * FROM " . static::$tabla . " WHERE id=${id}";
        $resultado=self::consultarSQL($query);

        return array_shift($resultado);
    }

   public static function consultarSQL($query) {
        // Debug: ver la consulta
        // echo $query; exit;
        
        $resultado = self::$db->query($query);
        
        if (!$resultado) {
            echo "Error en consulta SQL: " . self::$db->error;
            echo "<br>Query: " . $query;
            exit;
        }
        
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        
        $resultado->free();
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto=new static;

        foreach($registro as $key=>$value){
            if(property_exists($objeto, $key)){
                $objeto->$key=$value;
            }
        }
        return $objeto;
    }

    //Sincronizar
    public function sincronizar($args=[]){
        foreach($args as $key=>$value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key=$value;
            }
        }
    }

    //Obtener el número de registros
    public static function get($cantidad){
        $query="SELECT * FROM " . static::$tabla . " LIMIT $cantidad";
        $resultado=self::consultarSQL($query);

        return $resultado;
    }

    // Busca un registro por su columna
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    
    
}
