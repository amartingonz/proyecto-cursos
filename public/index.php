<?php

    require_once __DIR__.'../../vendor/autoload.php';
    use Dotenv\Dotenv;
    use Models\Ponente;
    use Lib\ResponseHttp;
    use Lib\Router;
    use Controllers\ApiponenteController;
    use Controllers\UsuarioController;
    USE Models\Usuario;


    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    // http_response_code(202);
    // $array = ["estado" => '202', "mensaje" => 'Estamos en el index principal'];
    // echo json_encode($array);
    
    //echo ResponseHttp::statusMessage(404,'La página de ponentes no existe');
    Router::add('GET','proyecto-cursos',function(){echo 'saludo';});

    Router::add('GET','auth',function(){require '../views/auth.php';});

    Router::add('GET','ponente',function(){
        (new ApiponenteController()) -> getAll();
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
    
    Router::dispatch();

?>