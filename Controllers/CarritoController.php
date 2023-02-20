<?php
    namespace Controllers;
    use Lib\Pages;
    use Services\CategoriaService;
    use Services\ProductoService;
    use Utils\Utils;


    
    class CarritoController{
        private ProductoService $service;
        private Pages $pages;
        private CategoriaController $categoria;
        private Utils $utils;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new ProductoService();
            $this -> categoria = new CategoriaController();
            $this -> utils = new Utils();
        }


        public function anadir_carrito(){
            // Funcion para añadir al carrito, se le añade a la sesion['carrito'] con el codProducto y las unidades.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $cod = $_POST['cod'];
                $unidades = $_POST['unidades'];
                $stock = intval($_POST['stock']);
                if(isset($_SESSION['carrito'][$cod])){
                    if(($_SESSION['carrito'][$cod] + $unidades) < $stock){
                        $_SESSION['carrito'][$cod] += $unidades; 
                    }else{
                        $_SESSION['carrito'][$cod] = $stock;
                    }
                }else{
                    $_SESSION['carrito'][$cod] = $unidades;
                }
                $productos = $this-> service -> getAll();
                $this -> pages -> render('productos/carrito',["productos" => $productos]);
            }else{
                $productos = $this-> service -> getAll();
                $this -> pages -> render('productos/carrito',["productos" => $productos]);
            }
        }

        public function borrar_elementos(){
            // Funcion para eliminar productos del carrito.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $cod = $_POST['cod'];
                $unidades = intval($_POST['unidades']);
                if(isset($_SESSION['carrito'][$cod])){
                    $_SESSION[ 'carrito'][$cod] -= $unidades;
                    if($_SESSION['carrito'][$cod] <= 0){
                        unset($_SESSION['carrito'][$cod]);
                    }
                }
                $productos = $this-> service -> getAll();
                $this -> pages -> render('productos/carrito',["productos" => $productos]);
            }else{
                $productos = $this-> service -> getAll();
                $this -> pages -> render('productos/carrito',["productos" => $productos]);
            } 
        }
    }