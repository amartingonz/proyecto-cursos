<?php 
    namespace Services;
    use Repositories\CategoriaRepository;

    class CategoriaService{
            private CategoriaRepository $repository;
        
            public function __construct(){
                $this->repository = new CategoriaRepository();
            }
        
            public function getAll(): ?array{
                return $this-> repository -> getAll();
            }
            
            public function crear_categoria(string $data):void {
                // Funcion que llama al repositorio al metodo crear_categoria
                $this -> repository -> crear_categoria($data);
            }
            
            public function comprobarCategoria(string $categoria){
                //Funcion para llamar al metodo del repositorio para saber si existe la categoria en la Base de Datos
                return $this -> repository -> comprobarCategoria($categoria);
            }

        }
    

?>