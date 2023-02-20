<?php
    namespace Controllers;
    use Lib\Pages;
    use Models\Usuarios;
    use Services\UsuarioService;
    use Utils\Utils;

    class UsuarioController{
        private UsuarioService $service;
        private Pages $pages;
        private CategoriaController $categoria;
        private Utils $utils;
        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new UsuarioService();
            $this -> categoria = new CategoriaController();
            $this -> utils = new Utils();
        }
        
        public function inicio(){
            $categorias = $this -> categoria -> listar_categorias();
            $this -> pages -> render('layout/header', ["categorias" => $categorias]);
        }


        public function registrar():void{
            //Funcion encargada de registrar usuarios he usado metodos de la clase utils para validar
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $email = $_POST['data']['email'];
                $datos = $_POST['data'];
                $errores = $this -> utils -> validar_registro($datos);
                $existe = $this -> service -> comprobarEmail($email);
                if($this -> utils -> sinErroresRegistro($errores)){
                    if(!$existe){
                        $this -> service -> save($_POST['data']);
                        $this-> pages-> render("layout/mensaje", ["mensaje" => "Usuario registrado"]);
                    }else{
                        $this-> pages-> render("layout/mensaje", ["mensaje" => "El email ya existe"]);
                    }
                }else{
                    $_SESSION['errores'] = $errores;
                    $this -> pages -> render('usuarios/registro');
                }
            }else{
                $this -> pages -> render('usuarios/registro');
            }
        }

    
      
        public function login():void{
            //Funcion encargada de verificar el login es decir que el email que se le pasa y las contraseñas sean los de la base de datos.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = $this -> service -> login($_POST['data']);
                if($datos != []){
                    $nuevo_usuario = new Usuarios($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5]);
                    $email = $nuevo_usuario -> getEmail();
                    $rol = $nuevo_usuario -> getRol();
                    $id = $_SESSION['id'] = $nuevo_usuario -> getId();
                    $_SESSION['nombre'] = $nuevo_usuario -> getNombre();
                    $_SESSION['email'] = $email;
                    if(password_verify($_POST['data']['password'],$nuevo_usuario -> getPassword())){
                        if($rol == 'admin'){
                            $_SESSION['admin'] = $nuevo_usuario;
                            $_SESSION['id_admin'] = $nuevo_usuario -> getId();
                        }else{
                            $_SESSION['usuario'] = $nuevo_usuario;
                            $_SESSION['id_usuario'] = $nuevo_usuario -> getId(); 
                        }
                        // $_SESSION['categorias'] = $this -> categoria -> listar_categorias();
                        
                        $this -> pages -> render('layout/mensaje',["mensaje" => "Has iniciado sesion"]);
                        header("Location:".$_ENV['BASE_URL']);

                        // header("Location:".$_ENV['BASE_URL']);
                    }else{
                        $this -> pages -> render('layout/mensaje',["mensaje" => "Error al iniciar sesion"]);
                }
                }else{
                    $this -> pages -> render('layout/mensaje',["mensaje" => "No hay datos en la base de datos"]);
                }
            }else{
                $this -> pages -> render('usuarios/login');

            }

        }


        public function editar_datos(){
            //Funcion encargada de editar datos de usuarios he usado metodos de la clase utils para validar
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = $_POST['data'];
                $errores = $this -> utils -> validar_registro($datos);
                if($this -> utils -> sinErroresRegistro($errores)){
                    $this -> service -> editar_datos($_POST['data']);
                    $this -> pages -> render('layout/mensaje',["mensaje" => "Has modificado tus datos con éxito"]);
                }else{
                    $_SESSION['errores'] = $errores;
                    $this -> pages -> render('usuarios/editar_datos');
                }
            }else{
                $this -> pages -> render('usuarios/editar_datos');
            }
        }

        public function cerrar_sesion(){
            // Funcion encargada de borrar las sesiones de usuarios.
            if(isset($_SESSION['usuario'])){
                unset($_SESSION['usuario']);
                session_destroy();
            }

            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
                session_destroy();
            }
            header("Location:".$_ENV['BASE_URL']);
        }














    }

    
?>