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
            $this -> usuario = new Usuario("","","","","","","","","");
            $this -> pages = new Pages();
        }


        public function register($data){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $usuario = new Usuario('','','','','','','','','');
                $data = json_decode(file_get_contents("php://input"));
                $valido = $usuario -> validarDatos($data);
                if($valido == true){
                    $usuario -> setNombre($data -> nombre);
                    $usuario -> setApellidos($data -> apellidos);
                    $usuario -> setEmail($data -> email);
                    $usuario -> setPassword(password_hash($data -> password,PASSWORD_DEFAULT));
                    $usuario -> setRol("usuario");
                    $usuario -> setConfirmado(false);
                    if($usuario -> register()){
                        http_response_code(201);
                        $response =  json_decode(ResponseHttp::statusMessage(202,'Usuario creado correctamente'));
                    }else{
                        http_response_code(503);
                        $response =  json_decode(ResponseHttp::statusMessage(503, 'Error al crear el usuario'));
                    }
                }else{
                    http_response_code(400);
                    $response =  json_decode(ResponseHttp::statusMessage(400, 'Error'. $valido));
                }
            }else{
                $response =  json_decode(ResponseHttp::statusMessage(405, 'Método no permitido. Usa POST'));
            }  
            $this -> pages -> render('read',['response' => $response]);
        }
    }



















?>