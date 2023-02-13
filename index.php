<?php

    require_once __DIR__.'/vendor/autoload.php';
    use Dotenv\Dotenv;
    use Models\Ponente;
    use Lib\ResponseHttp;
    use Lib\Router;
    use Controllers\ApiponenteController;


    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    http_response_code(202);
    $array = ["estado" => '202', "mensaje" => 'Estamos en el index principal'];
    echo json_encode($array);
    
    //echo ResponseHttp::statusMessage(404,'La página de ponentes no existe');
    Router::add('GET','proyecto-cursos',function(){echo 'saludo';});

    Router::add('GET','auth',function(){require '../views/auth.php';});

    Router::add('GET','proyecto-cursos/ponente',function(){
        (new ApiponenteController()) -> getAll();
    });

    Router::add('GET','proyecto-cursos/ponente/:id',function(int $ponenteid){
         (new ApiponenteController()) -> getPonente($ponenteid);
    });

    
    Router::dispatch();

?>