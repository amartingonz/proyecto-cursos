<?php 
    namespace Services;
    use Repositories\UsuarioRepository;

    class UsuarioService{
            private UsuarioRepository $repository;
        
            function __construct() {
                $this->repository = new UsuarioRepository();
            }
        
            public function comprobarEmail(string $email){
                //Funcion para llamar al metodo del repositorio para saber si existe el email en la Base de Datos
                return $this -> repository -> comprobarEmail($email);
            }

            public function save(array $usuario) : void {
                //Funcion para guardar que usa el metodo del repositorio, donde se le pasa un array de datos.
                $this -> repository -> save($usuario);
            }
            
            public function login(array $usuario):?array{
                //Funcion para login que usa el metodo del repositorio, donde se le pasa un array de datos.
                return $this -> repository -> login($usuario);
            }

            public function editar_datos(array $usuario):void{
                //Funcion para editar datos que usa el metodo del repositorio, donde se le pasa un array de datos.
                $this -> repository -> editar_datos($usuario);
            }
        }

    

?>