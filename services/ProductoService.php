<?php 
    namespace Services;
    use Repositories\ProductoRepository;

    class ProductoService{
            private ProductoRepository $repository;
        
            public function __construct(){
                $this->repository = new ProductoRepository();
            }
        
            public function crear_producto(array $data):void {
                // Funcion para crear productos que usa el metodo del repositorio crear_productos, se le pasa un array de datos
                $this -> repository -> crear_producto($data);
            }
            
            public function getAll(): ?array{
                return $this-> repository -> getAll();
            }

            public function editar_producto(array $data):void{
                // Funcion para editar productos que usa el metodo del repositorio editar_productos
                $this -> repository -> editar_producto($data);
            }

            public function comprobarProducto(string $producto){
                //Funcion para llamar al metodo del repositorio para saber si existe el producto en la Base de Datos
                return $this -> repository -> comprobarProducto($producto);
            }

            public function listarXcategorias($data):? array{
                // Funcion para listar productos que usa el metodo del repositorio listarXcategorias, devuelve un array
                return $this -> repository -> listarXcategorias($data);

            }

            public function ver_carrito($cod):?array{
                
                return $this -> repository -> buscarProducto($cod);
            }

            public function sacarNombre($id):?array{
                return $this -> repository -> sacarNombre($id);
            }

            public function borrar_productos($id):void{
                // Funcion para borrar productos que usa el metodo del repositorio borrar_productos
                $this -> repository -> borrar_producto($id) ;
            }
        }
?>