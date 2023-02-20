<?php 
    namespace Services;
    use Repositories\PedidoRepository;

    class PedidoService{
            private PedidoRepository $repository;
        
            public function __construct(){
                $this->repository = new PedidoRepository();
            }

            public function crear_pedido(array $data):void{
                // funcion que llama al metodo del repositorio crear_pedido
                $this -> repository -> crear_pedido($data);
            }
        
            public function ultimoPedidoInsertado(){
                // funcion que llama al metodo del repositorio ultimopedidoinsertado devuelve el id del ultimo pedido
                return $this -> repository -> ultimoPedidoInsertado();
            }
           
            public function crear_lineaPedido($pedido_id,$carrito){
                // funcion que llama al metodo del repositorio crear_lineadepedido
                $this -> repository -> crear_lineaPedido($pedido_id,$carrito);
            }

            public function consultar_pedidos($id):?array{
                // funcion que llama al metodo del repositorio consultar_pedidos
                return $this -> repository -> consultar_pedidos($id);
            }
        }
    