    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
    
        <?php
            use Repositories\CategoriaRepository;
            use Models\Categoria;
        ?>
           <h1>Tienda</h1>
           <?php
                if(!isset($_SESSION['carrito'])){
                    $_SESSION['carrito'] = [];
                }
        ?>
        
        <nav class="menu">
            <ul>
            <li>
                    <a href="./">Inicio</a> 
            </li>
            <?php if(!isset($_SESSION['usuario']) && !isset($_SESSION['admin'])){?>
                <li>
                    <a href="usuarios_registrar">Registrar</a>
                </li>
                <li>
                    <a href="usuarios_loguear">Login</a>
                </li>
                <li>
                    <a href="anadir_carrito">Ver carrito</a>
                </li>
            <?php }?>
            </ul>
        </nav>

        <?php if(isset($_SESSION['admin'])):?>
        <nav class="menu"> 
            <ul>
                <li><a href="anadir_carrito">Ver carrito</a></li>
                <li><a href="consultar_pedidos">Ver pedidos</a></li>
                <li><a href="crear_categoria">Crear Categorias</a></li>
                <li><a href="crear_producto">Crear Productos</a></li>
                <li><a href="editar_datos">Editar Datos</a></li>
                <li><a href="cerrar_sesion">cerrar sesion</a></li>
            </ul>
        </nav>
        <?php endif;?>


        <?php if(isset($_SESSION['usuario'])):?>
            <nav class="menu">
                <ul>
                    <li><a href="anadir_carrito">Ver carrito</a></li>
                    <li><a href="consultar_pedidos">Ver pedidos</a></li>
                    <li><a href="editar_datos">Editar Datos</a></li>
                    <li><a href="cerrar_sesion">cerrar sesion</a></li>
                </ul>
            </nav>
        <?php endif;?>
        <br>
      

    