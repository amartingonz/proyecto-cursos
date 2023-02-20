<?php
    namespace Controllers;

    use Firebase\JWT\JWT;
    use Lib\Email;
    use Models\Usuario;
    use Lib\ResponseHttp;
    use Lib\Pages;
    use Lib\Security;
    use Utils\Utils;



    class UsuarioController{

        private Pages $pages;
        private Usuario $usuario;
        private Utils $utils;

        public function __construct()
        {
            ResponseHttp::setHeaders();
            $this -> usuario = new Usuario();
            $this -> pages = new Pages();
            // $this -> utils = new Utils();

        }


        public function register(){
            // Funcion para registrarse en la base de datos.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = $_POST['data'];
                // $errores = $this -> utils -> validar_registro($data);
                // if($this -> utils -> sinErroresRegistro($errores)){
                    if(!$this -> usuario -> comprobar_email($data)){
                        $usuario = $this -> usuario -> register($data);
                        $id = $this -> usuario -> max_id($data['email']);
                        // crear la clave secreta
                        $key = Security::clavesecreta();
                        // crear el token a traves de la clave $key y el email
                        $token = Security::crearToken($key, $data['email']);
                        // encode del token
                        $encodedToken = JWT::encode($token, $key, 'HS256');
                        //añadir el token al usuario
                        $this->usuario->guardarToken($id,$encodedToken,$token['exp']);
                        $email = new Email($data['email'],$encodedToken);
                        $email -> enviarConfirmacion();
                    }else{
                        $this-> pages-> render("layout/mensaje", ["mensaje" => "El email ya existe"]);
                    }
                // }else{
                //         $_SESSION['errores'] = $errores;
                //         $this -> pages -> render('/registro');
                //     }        
    }}

        public function login(){
            // Funcion para loguear el usuario con email y password, comprobando que el usuario existe en nuestra base de datos.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = json_decode(file_get_contents("php://input"));

                $datos = $this -> usuario -> login($data->email);
                
                $UsuarioArr = [];
                if($datos != []){
                    if(password_verify($data -> password,$datos[4])){
                
                        $usuario = new Usuario($datos);
                        $UsuarioArr["message"] = json_decode(ResponseHttp::statusMessage(202,'Usuario logeado correctamente'));
                        $UsuarioArr["Usuario"] = [];
                        // crear la clave secreta
                        $key = Security::claveSecreta();
                        // crear el token a traves de la clave $key y el email
                        $token = Security::crearToken($key,$data->email);
                        // encode del token
                        $encodedToken = JWT::encode($token, $key, 'HS256');
                        //añadir el token al usuario
                        
                        $usuario -> guardarToken($datos[0],$encodedToken,$token['exp']);
                        $usuario -> setToken($encodedToken);
                        $usuario-> setToken_esp($token['exp']);
                        http_response_code(200);
                        $response["message"] = json_decode(ResponseHttp::StatusMessage(200, 'OK'));
                        $user = $datos;
                        unset($user[4]);
                        $resultado = ["response" => $response, "user" => $user];
                        $this->pages->render('read', ['response' => json_encode($resultado)]);
                        return null;
                        }else{
                            $UsuarioArr["message"] = json_decode(ResponseHttp::statusMessage(503, 'Las contraseñas no coinciden'));
                            $UsuarioArr["Usuario"] = []; 
                    }} if($UsuarioArr==[]){
                        $response = json_encode($UsuarioArr["message"]);
                    }else{
                        $response = json_encode($UsuarioArr);
                    }
                    $this -> pages -> render('read',['response' => $response]); 
                }
        }

        public function confirmar_email($token){
            // Funcion parar confirmar el email, una vez que se confirma se pone en la base de datos que esta confirmado y luego se borra el token.
           $tokens =  $this -> usuario -> confirmarEmail($token);
           $this -> usuario -> borrar_token($token);
           $UsuarioArr = [];
            if(!empty($tokens)){
                $UsuarioArr["message"] = json_decode(ResponseHttp::statusMessage(202,'Confirmado con éxito'));
                $UsuarioArr["Usuario"] = [];
            }else{
                $UsuarioArr["message"] = json_decode(ResponseHttp::statusMessage(400, 'Distintos tokens'));
                $UsuarioArr["Usuario"] = [];
            }
            if($UsuarioArr==[]){
                $response = json_encode(ResponseHttp::statusMessage(400,'No hay ponentes'));
            }else{
                $response = json_encode($UsuarioArr);
            }
          
           $this -> pages -> render('read',['response' => $response]);
       }

    }















?>