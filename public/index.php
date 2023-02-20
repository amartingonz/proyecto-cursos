<?php
    session_start();
    require_once __DIR__.'../../vendor/autoload.php';

    use Dotenv\Dotenv;
    use Controllers\CategoriaController;
    use Controllers\CarritoController;
    use Controllers\PedidoController;
    use Controllers\ProductoController;
    use Controllers\UsuarioController;
    use Lib\Router;
    USE Models\Usuario;
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
    require_once '../views/layout/header.php';

    // // INDEX
    Router::add('GET','/',function(){require '../index.php';});

    // REGISTRO
    Router::add('GET','usuarios_registrar',function(){require '../views/usuarios/registro.php';});
    Router::add('POST','usuarios_registrar',function(){
        (new UsuarioController()) -> registrar();});

    // LOGIN
    Router::add('GET','usuarios_loguear',function(){require '../views/usuarios/login.php';});
    Router::add('POST','usuarios_loguear',function(){
        (new UsuarioController()) -> login();});

    // CERRAR SESION
    Router::add('GET','cerrar_sesion',function(){
        require '../views/usuarios/cerrar_sesion.php';}
    );
    Router::add('POST','cerrar_sesion',function(){
        (new UsuarioController()) -> cerrar_sesion();});

    Router::add('GET','listarXcategorias/:id',function(int $id){
         (new ProductoController()) -> listarXcategorias($id);
    });



        


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

<h1>hola</h1>