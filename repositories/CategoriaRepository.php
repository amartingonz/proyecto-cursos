<?php
    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Categoria;
    use PDO;
    use PDOException;

    class CategoriaRepository{
        private BaseDatos $conexion;

        public function __construct(){
            $this-> conexion = new BaseDatos();
        }

        
        public function crear_categoria(string $data):void{
            // Funcion para crear categorias con la consulta INSERT
            $sql = ("INSERT INTO categorias (nombre) VALUES (:nombre)");
            $consult = $this -> conexion -> prepara($sql);
            $consult -> bindParam(':nombre',$data,PDO::PARAM_STR);
            try{
                $consult -> execute();
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
            }
        }

        public function getAll():? array{
            // Funcion para conseguir un array de todos los campos de la tabla categorias
            $this -> conexion -> consulta('SELECT * FROM categorias');
            return $this -> conexion -> extraer_todos();
        }

        public function comprobarCategoria($categoria):bool{
            // Funcion para comprobar si existe una categoria
            $result = false;
            $cons = $this->conexion->prepara("SELECT * FROM categorias WHERE nombre = :nombre");
            $cons->bindParam(':nombre', $categoria);
            try{
                $cons->execute();
                if($cons && $cons->rowCount() == 1){
                    $result = true;
                }
            } catch(PDOException $err){
                $result = false;
            }
            return $result;
        }
        
        public static function obtenerCategorias(){
            $categoria=new CategoriaRepository();
            $categoria->conexion->consulta("SELECT * FROM categorias ORDER BY id");
            return $categoria->extraer_todos(); 
        }

        public function extraer_todos():?array{
            $categorias = [];
            $categoriasData = $this -> conexion -> extraer_todos();
            foreach($categoriasData as $categoriaData){
                $categorias[] = Categoria::fromArray($categoriaData);
            }
            return $categorias;
        }

        
    }
    

        
