<?php
    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Entradas;
    use Models\Productos;
    use PDO;
    use PDOException;

    class ProductoRepository{
        private BaseDatos $conexion;

        public function __construct(){
            $this-> conexion = new BaseDatos();
        }

        public function borrar_producto($id):bool{
            $sql = ("UPDATE productos SET stock = 0 WHERE id=:id");
            $consult = $this -> conexion -> prepara($sql);
            $consult -> bindParam(':id',$id,PDO::PARAM_INT);
            try{
                $consult->execute();
                return true;
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
                return false;
            }
        }
        //
        public function crear_producto(array $data):void {
            //Funcion para crear productos pasandole el array recogido del formulario
            $sql = ("INSERT INTO productos (categoria_id,nombre,descripcion,precio,stock,oferta,fecha,imagen) VALUES((SELECT id FROM categorias WHERE nombre = :categoria_id),:nombre,:descripcion,:precio,:stock,:oferta,:fecha,:imagen)");
            $fecha = date("Y-m-d");
            $archivo = $_FILES['data']['name'];
            $precio = ($data['precio']) - ($data['precio'] * $data['oferta'] / 100);
            $consult = $this -> conexion -> prepara($sql);

            $consult -> bindParam(':categoria_id',$data['categoria'],PDO::PARAM_STR);
            $consult -> bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $consult -> bindParam(':descripcion',$data['descripcion'],PDO::PARAM_STR);
            $consult -> bindParam(':precio',$precio,PDO::PARAM_STR);
            $consult -> bindParam(':stock',$data['stock'],PDO::PARAM_STR);
            $consult -> bindParam(':oferta',$data['oferta'],PDO::PARAM_STR);
            $consult -> bindParam(':fecha',$fecha,PDO::PARAM_STR);
            $consult -> bindParam(':imagen',$archivo['imagen'],PDO::PARAM_STR);

            try{
                // var_dump($data);die();
                $consult -> execute();
                // return true;
                
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
                // return false;
            }
        }

        public function editar_producto(array $data):void {
            //Funcion para editar productos pasandole el array recogido del formulario
            $sql = ("UPDATE productos SET descripcion=:descripcion,precio=:precio,stock=:stock,oferta=:oferta,fecha=:fecha,imagen=:imagen WHERE id=:id;");
            $fecha = date("Y-m-d");
            $archivo = $_FILES['data']['name'];

            
            $precio = ($data['precio']) - ($data['precio'] * $data['oferta'] / 100);
            $consult = $this -> conexion -> prepara($sql);

            $consult -> bindParam(':id',$data['id'],PDO::PARAM_INT);
            $consult -> bindParam(':descripcion',$data['descripcion'],PDO::PARAM_STR);
            $consult -> bindParam(':precio',$precio,PDO::PARAM_STR);
            $consult -> bindParam(':stock',$data['stock'],PDO::PARAM_STR);
            $consult -> bindParam(':oferta',$data['oferta'],PDO::PARAM_STR);
            $consult -> bindParam(':fecha',$fecha,PDO::PARAM_STR);
            $consult -> bindParam(':imagen',$archivo['imagen'],PDO::PARAM_STR);

            try{
                // var_dump($data);die();
                $consult -> execute();
                // return true;
                
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
                // return false;
            }
        }












        public function getAll():? array{
            //Consulta para extraer todos los campos de productos
            $this -> conexion -> consulta('SELECT * FROM productos');
            return $this -> conexion -> extraer_todos();
        }

        public function comprobarProducto($producto):bool{
            // Funcion que comprueba si un producto existe
            $result = false;
            $cons = $this->conexion->prepara("SELECT * FROM productos WHERE nombre = :nombre");
            $cons->bindParam(':nombre', $producto);
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

        public function buscarProducto($cod):?array{
            $sql = ("SELECT * FROM productos WHERE id = $cod");
            $this -> conexion -> consulta($sql);
            return $this -> conexion -> extraer_todos();
        }
        
        public function listarXcategorias($data):? array{
            //Consulta para extraer todos los campos de productos por categorias
            $sql = ("SELECT * FROM productos WHERE categoria_id = $data");
            $this -> conexion -> consulta($sql);
            return $this -> conexion -> extraer_todos();
        }


        public function extraer_todos():?array{
            // Devuelve un array, llama al metodo extraer todos de la base de datos
            $productos = [];
            $ProductoData = $this -> conexion -> extraer_todos();
            foreach($ProductoData as $ProductoData){
                $productos[] = Productos::fromArray($ProductoData);
            }
            return $productos;
        }

        public function sacarNombre($data){
            $sql = ("SELECT nombre FROM productos WHERE id = $data");
            $this -> conexion -> consulta($sql);
            return $this -> conexion -> extraer_todos();
        }

        public function filasAfectadas(){
            return $this -> conexion -> filasAfectadas();
        }

    

       
    }