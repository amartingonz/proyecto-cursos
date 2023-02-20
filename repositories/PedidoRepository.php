<?php
    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Pedidos;
    use PDO;
    use PDOException;

    class PedidoRepository{
        private BaseDatos $conexion;

        public function __construct(){
            $this-> conexion = new BaseDatos();
        }

        public function crear_pedido(array $data):void{
                //Funcion para crear el pedido se le pasa los datos mediante un array recogido del formulario
                $sql = ("INSERT INTO pedidos (usuario_id,provincia,localidad,direccion,coste,fecha,hora) VALUES (:usuario_id,:provincia,:localidad,:direccion,:coste,:fecha,:hora)");
                $fecha = date("Y-m-d");
                $hora = date("H:i:s");
                $consult = $this -> conexion -> prepara($sql);
                $id = intval($data['usuario_id']);

                $consult -> bindParam(':usuario_id',$id,PDO::PARAM_INT);
                $consult -> bindParam(':provincia',$data['provincia'],PDO::PARAM_STR);
                $consult -> bindParam(':localidad',$data['localidad'],PDO::PARAM_STR);
                $consult -> bindParam(':direccion',$data['direccion'],PDO::PARAM_STR);
                $consult -> bindParam(':coste',$data['coste'],PDO::PARAM_STR);
                //$consult -> bindParam(':estado','NULL',PDO::PARAM_STR);
                $consult -> bindParam(':fecha',$fecha,PDO::PARAM_STR);
                $consult -> bindParam(':hora',$hora,PDO::PARAM_STR);
                
                try{
                    $consult -> execute();
                }catch(PDOException $err){
                    echo "Error".$err -> getMessage();
                }
        }

        public function ultimoPedidoInsertado(){
            //Funcion para sacar el ultimo pedido insertado
            $sql = ("SELECT MAX(id) FROM pedidos");
            $this -> conexion -> consulta($sql);
            return $this -> conexion -> extraer_registro();
        }
        
        public function crear_lineaPedido($pedido_id,$carrito){
            // Funcion para crear la linea de pedido
            foreach($carrito as $codProd=>$unidades){
                $sql = ("INSERT INTO lineas_pedidos(pedido_id,producto_id,
                unidades)values(:pedido_id,:codProd,:unidades)");
                $consult = $this -> conexion -> prepara($sql);
                $consult -> bindParam(':pedido_id',$pedido_id,PDO::PARAM_INT);
                $consult -> bindParam(':codProd',$codProd,PDO::PARAM_STR);
                $consult -> bindParam(':unidades',$unidades,PDO::PARAM_STR);
                $this -> conexion -> iniciar_transaccion();
                $result = $consult -> execute();
                if(!$result){
                    $this -> conexion -> rollback();
                    return FALSE;
                }
                $sql = "UPDATE productos SET stock = stock - :unidades WHERE id = :codProd"; 
                $consult = $this -> conexion -> prepara($sql);
                $consult -> bindParam(':unidades',$unidades,PDO::PARAM_INT);
                $consult -> bindParam(':codProd',$codProd,PDO::PARAM_STR);
                $result = $consult -> execute();
                if(!$result){
                    $this -> conexion -> rollback();
                    return FALSE;
                }
                $this -> conexion -> commit();
        }
    }

    public function consultar_pedidos($id):?array{
            //Consulta para extraer todos los campos de pedidos por id de usuario
            $sql = ("SELECT * FROM pedidos WHERE usuario_id = $id" );
            $this -> conexion -> consulta($sql);
            return $this -> conexion -> extraer_todos();
        }
    

}