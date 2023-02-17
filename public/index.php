<?php

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

    
    Router::add('GET','proyecto-cursos',function(){echo 'saludo';});

    Router::add('GET','auth',function(){require '../views/auth.php';});

    Router::add('GET','ponente',function(){
        (new ApiponenteController()) -> getAll();
    });

    Router::add('GET', 'confirmar-cuenta/:id', function(string $token){
        (new UsuarioController())->confirmar_email($token);
    });

    Router::add('GET','/ponente/:id',function(int $ponenteid){
         (new ApiponenteController()) -> getPonente($ponenteid);
    });
    
    Router::add('POST','/usuario/register',function(){
         (new UsuarioController()) -> register();
   });
   
    Router::add('POST','/usuario/login',function(){
        (new UsuarioController()) -> login();
    });

    Router::add('DELETE', 'ponente/:id', function(int $ponenteid){
        (new ApiponenteController())->delPonente($ponenteid);
    });

    Router::add('POST', 'ponente', function(){
        (new ApiponenteController())->savePonente();
    });

    Router::add('PUT', 'ponente', function(){
        (new ApiponenteController())->updatePonente();
    });
    
    Router::dispatch();

?>