<?php
    namespace Controllers;
    use Lib\Pages;
    use Models\Categoria;
    use Services\CategoriaService;
    use Utils\Utils;

    
    class CategoriaController{
        private CategoriaService $service;
        private Pages $pages;
        private Utils $utils;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new CategoriaService();
            $this -> utils = new Utils();
        }

        public function crear_categoria(){
            // Funcion encargada llamar al metodo de service para crear la categoria con el array que se coge del formulario.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = $_POST['nombre'];
                $errores = $this -> utils -> validar_crearCategoria($datos);
                $existe = $this -> service -> comprobarCategoria($datos);
                if($this -> utils -> sinErrorescrearCategoria($errores)){
                    if(!$existe){
                        $this -> service -> crear_categoria($_POST['nombre']);
                        $categorias = $this -> listar_categorias();
                        $_SESSION['categorias'] = $categorias;
                        $this -> pages -> render('categorias/crear_categoria');
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "Categoria creada con éxito"]);  
                    }else{
                        $this-> pages-> render("layout/mensaje", ["mensaje" => "La categoria ya existe"]);
                    }
                }else{
                    $_SESSION['errores'] = $errores;
                    $this -> pages -> render('categorias/crear_categoria');
                }
            }else{
                $this -> pages -> render('categorias/crear_categoria');
            }
        }

        public function listar_categorias():?array{
            // Funcion para listar categorias.
            $categorias = $this-> service -> getAll();
            return $categorias;
        }

        
    }



    ?>