<?php   

    namespace Lib;

    use Dotenv\Dotenv;
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
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
            $decodeToken = JWT::decode($token,new Key(Security::clavesecreta(), 'HS256'));
            return $decodeToken;
            }catch (PDOException $exception){
            return $response['message']= json_encode(ResponseHttp::statusMessage(401,'Token expirado o invalido'));
           }
           }
           


    }
?>