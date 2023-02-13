<?php
    namespace Controllers;
    use Models\Usuario;
    use Lib\ResponseHttp;
    use Lib\Pages;

    class UsuarioController{

        private Pages $pages;
        private Usuario $usuario;
        
        public function __construct()
        {
            ResponseHttp::setHeaders();
            $this -> usuario = new Usuario();
            $this -> pages = new Pages();
        }


        public function register(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = json_decode(file_get_contents("php://input"));
                $UsuarioArr = [];
                if(!$this -> usuario -> comprobar_email($data)){
                    $usuario = $this -> usuario -> register($data);
                }else{
                    $response = "Email repetido";
                }
                if(!empty($usuario)){
                    $UsuarioArr["message"] = json_decode(ResponseHttp::statusMessage(202,'Usuario creado correctamente'));
                    $UsuarioArr["Usuario"] = [];
                }else{
                    $UsuarioArr["message"] = json_decode(ResponseHttp::statusMessage(503, 'Error al crear el usuario'));
                    $UsuarioArr["Usuario"] = []; 
                    }
                } if($UsuarioArr==[]){
                    $response = json_encode($UsuarioArr["message"]);
                }else{
                    $response = json_encode($UsuarioArr);
                }
                $this -> pages -> render('read',['response' => $response]);
                
           
        }
    }



















?>