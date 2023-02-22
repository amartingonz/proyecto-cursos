<?php
    namespace Controllers;
    use Lib\Pages;
    use Models\Productos;
    use Services\CategoriaService;
    use Services\ProductoService;
    use Utils\Utils;


    
    class ProductoController{
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

        public function index(){
            header('Location:'.$_ENV['BASE_URL']);
        }


        public function borrar_producto(){
            // CREAR LUEGO LA FUNCION PARA BORRARLA.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                

            }else{

            }
        }

        public function crear_producto(){
            if(!file_exists('images')){
                mkdir('images');
            }
            // Funcion encargada de crear los productos, he usado metodos de la clase utils para validar los datos.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = $_POST['data'];
                $nombre = $_POST['data']['nombre'];
                $archivo = $_FILES['data']['name'];
                
                $errores = $this -> utils -> validar_crearProductos($datos);
                $existe = $this -> service -> comprobarProducto($nombre);

                if($this -> utils -> sinErrorescrearProductos($errores)){
                    if(!$existe){
                        if (isset($archivo) && $archivo != "") {
                            $tipo = $_FILES['data']['type'];
                            $tamano = $_FILES['data']['size'];
                            $temp = $_FILES['data']['tmp_name'];
                            /*
                            if (!((strpos($tipo['imagen'], "image/gif") || strpos($tipo['imagen'], "image/jpeg") || strpos($tipo['imagen'], "image/jpg") || strpos($tipo['imagen'], "image/png")) && (intval($tamano['imagen']) < 200000000))) {
                                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                             } else {
                            */
                                //Si la imagen es correcta en tamaño y tipo
                                //Se intenta subir al servidor
                                if (move_uploaded_file($temp['imagen'], 'images/'.$archivo['imagen'])) {
                                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                                chmod('images/'.$archivo['imagen'], 0777);
                                    //Mostramos el mensaje de que se ha subido co éxito
                                echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                    //Mostramos la imagen subida
                                //echo '<p><img src="../images/'.$archivo['imagen'].'"></p>';
                            }else{
                                   //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                            }
                            }
                        $this -> service -> crear_producto($_POST['data']);
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "Producto insertado con exito"]);
                    }else{
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "Producto ya existente"]);
                    }
                }else{
                    $categorias = $this -> categoria -> listar_categorias();
                    $this -> pages -> render('productos/crear_productos', ["categorias" => $categorias]);
                    $_SESSION['errores'] = $errores;
                    $this -> pages -> render('productos/crear_productos');
                }
            }else{
                $categorias = $this -> categoria -> listar_categorias();
                $this -> pages -> render('productos/crear_productos', ["categorias" => $categorias]);
            }
        }

        public function editar_producto(){
            if(!file_exists('images')){
                mkdir('images');
            }
            // Funcion encargada de crear los productos, he usado metodos de la clase utils para validar los datos.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = $_POST['data'];
                $id = $_POST['data']['id'];
                $nombre = $this -> service -> sacarNombre($id);
                $archivo = $_FILES['data']['name'];
                        if (isset($archivo) && $archivo != "") {
                            $tipo = $_FILES['data']['type'];
                            $tamano = $_FILES['data']['size'];
                            $temp = $_FILES['data']['tmp_name'];
                            /*
                            if (!((strpos($tipo['imagen'], "image/gif") || strpos($tipo['imagen'], "image/jpeg") || strpos($tipo['imagen'], "image/jpg") || strpos($tipo['imagen'], "image/png")) && (intval($tamano['imagen']) < 200000000))) {
                                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                             } else {
                            */
                                //Si la imagen es correcta en tamaño y tipo
                                //Se intenta subir al servidor
                                if (move_uploaded_file($temp['imagen'], 'images/'.$archivo['imagen'])) {
                                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                                chmod('images/'.$archivo['imagen'], 0777);
                                    //Mostramos el mensaje de que se ha subido co éxito
                                echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                    //Mostramos la imagen subida
                                //echo '<p><img src="../images/'.$archivo['imagen'].'"></p>';
                            }else{
                                   //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                            }
                        $this -> service -> editar_producto($_POST['data']);
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "Producto insertado con exito"]);
                    }else{
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "Producto ya existente"]);
                    }
            }else{
                $categorias = $this -> categoria -> listar_categorias();
                $productos = $this -> service -> getAll();

                $this -> pages -> render('productos/editar_productos', ["categorias" => $categorias,"productos" => $productos]);
            }
        }


        public function listar_productos(){
            // Funcion encargada de listar los productos de la base de datos
            $_SESSION['categorias'] = $this -> categoria -> listar_categorias();
            $productos = $this-> service -> getAll();
            $this -> pages -> render('productos/listar_productos', ["productos" => $productos]);

        }


        public function listarXcategorias($id){
            // Esta funcion sirve para listar los productos por categorias es decir una vez iniciada la sesion, si pinchas en una
            // categoria te muestra los productos de dicha categoria.
                // $id = $_GET['categoria'];
                $productos = $this -> service -> listarXcategorias($id);
                $this -> pages -> render('productos/listarXcategorias', ["productos" => $productos]); 
                
        }


    

        
    }



    ?>