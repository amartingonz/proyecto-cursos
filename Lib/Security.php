<?php   

    namespace Lib;

    use Dotenv\Dotenv;
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use Models\Usuario;
    use PDOException;


    class Security{



        final public static function clavesecreta(){
            $dotenv=Dotenv::createImmutable(dirname(__DIR__.'/'));
            $dotenv->load();
            return $_ENV['SECRET_KEY'];
        }

        final public static function encriptaPassw(string $passw): string {
            $passw= password_hash($passw, PASSWORD_DEFAULT);
            return $passw;
        }
    
        final public static function validaPassw(string $passw, string $passwash): bool {
            if (password_verify($passw, $passwash)) {
                return true;
            }
            else {
                echo "contraseña incorrecta";
                return false;
            }
        }

        final public static function crearToken(string $key, string $data) {
            $time= strtotime("now");
            $token= array(
                "iat"=>$time,
                "exp"=>$time + 3600,
                "data"=>$data
            );
            // return JWT::encode($token, $key, 'HS256') ;
            return $token;
        }

        final public static function getToken(){
            $headers = apache_request_headers();// recoger las cabeceras en el servidor Apache
            if(!isset($headers['Authorization'])) { // comprobamos que existe la cabecera authoritation
                return $response['message'] = json_decode( ResponseHttp::statusMessage(403,'Acceso denegado'));
            }
            try{
                $authorizationArr = explode(' ',$headers['Authorization']);
                $token = $authorizationArr[1];
                $time = strtotime("now");
                $usuario = new Usuario();
                $exp = $usuario -> tokenExp($token);


                if($exp >= $time){
              
                    $decodeToken = JWT::decode($token,new Key(Security::clavesecreta(), 'HS256'));
                    return $decodeToken;
                }else{
                    return $response['message']= json_encode(ResponseHttp::statusMessage(401,'Token expirado'));
 
                }
            }catch (PDOException $exception){
                return $response['message']= json_encode(ResponseHttp::statusMessage(401,'Token expirado o invalido'));
           }
           }
           
           final public static function getId(){
            $headers = apache_request_headers();// recoger las cabeceras en el servidor Apache
            if(!isset($headers['id'])) { // comprobamos que existe la cabecera authoritation
                return $response['message'] = json_decode( ResponseHttp::statusMessage(403,'Acceso denegado'));
            }
            try{
                $idArr = explode(' ',$headers['id']);
                $id = $idArr[1];
                $id_usuario = new Usuario();
                $confirmacion = $id_usuario -> comprobarConfirmado($id);
                if($confirmacion == 1) {
                    return true;
                }else{
                    return false;
                }
            }catch (PDOException $exception){
                return $response['message']= json_encode(ResponseHttp::statusMessage(401,'Token expirado o invalido'));
           }
           }

           final public static function validateConfirmado():bool{
            //  Funcion que he creado para poder validar si esta confirmado el usuario
            $info = self::getId();
            if (gettype($info) == "boolean"){
                if($info == 1){
                    return true;
                }else{
                    return false;
                }}
        }

           final public static function validateToken():bool{
                $info = self::getToken();
                if(isset($info -> data)){

                    return true;
                }else{
                    return false;
                }
           }
    }
?>