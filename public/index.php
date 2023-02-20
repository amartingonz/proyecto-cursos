<?php
    require_once '../views/layout/header.php';

    require_once __DIR__.'../../vendor/autoload.php';
    use Dotenv\Dotenv;
    use Models\Ponente;
    use Lib\ResponseHttp;
    use Controllers\ApiponenteController;
    use Controllers\UsuarioController;
    use Lib\Router;
    USE Models\Usuario;


    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();


    // Router::add('GET','proyecto-cursos',function(){echo 'saludo';});
    Router::add('GET','/',function(){require '../index.php';});
    Router::add('GET','/registro',function(){require '../views/Usuario/registro.php';});
    Router::add('POST','/registro',function(){
        (new UsuarioController()) -> register();
    });

        // 
//     Router::add('GET','auth',function(){require '../views/auth.php';});

//     // Obtener todos los ponentes mediante el metodo get
//     Router::add('GET','ponente',function(){
//         (new ApiponenteController()) -> getAll();
//     });

//     // Confirmar mediante el metodo get el correo
//     Router::add('GET', 'confirmar-cuenta/:id', function(string $token){
//         (new UsuarioController())->confirmar_email($token);
//     });
//     // Obtener mediante metodo get el ponente por su id
//     Router::add('GET','/ponente/:id',function(int $ponenteid){
//          (new ApiponenteController()) -> getPonente($ponenteid);
//     });
//     // Registrar un usuario mediante el metodo post
//     Router::add('GET','/Usuario/register',function(){
//          (new UsuarioController()) -> register();
//    });
//    // Loguearse con email y password mediante el metodo post
//     Router::add('POST','/usuario/login',function(){
//         (new UsuarioController()) -> login();
//     });
//     // Borrar un ponente mediante su id por el metodo delete
//     Router::add('DELETE', 'ponente/:id', function(int $ponenteid){
//         (new ApiponenteController())->delPonente($ponenteid);
//     });
//     // Guardar ponentes mediante el metodo post
//     Router::add('POST', 'ponente', function(){
//         (new ApiponenteController())->savePonente();
//     });
//     // Actualizar ponentes mediante el metodo PUT
//     Router::add('PUT', 'ponente', function(){
//         (new ApiponenteController())->updatePonente();
//     });
    
    Router::dispatch();
    require_once '../views/layout/footer.php';
?>

