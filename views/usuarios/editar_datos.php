<link rel="stylesheet" href="./css/style.css">
<?php
    if(isset($_SESSION['admin'])){
            $datos = $_SESSION['id_admin'];
        }else{
            $datos = $_SESSION['id_usuario'];
    }
?>
<br>
<h2>Editar Datos de Usuario</h2>
<form action="<?= base_url ?>Usuario/editar_datos" method="post">

    <input type="hidden" name="data[id_usuario]" value="<?= $datos ?>">
    <label for="nombre">Nombre</label>
    <br>
    <input type="nombre" name="data[nombre]">
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['nombre'])){
            echo $_SESSION['errores']['nombre'];
        }
    } ?></span>
    <br>
    <label for="apellidos">Apellidos</label>
    <br>
    <input type="apellidos" name="data[apellidos]">
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['apellidos'])){
            echo $_SESSION['errores']['apellidos'];
        }

    } ?></span>
    <br>
    <label for="email">Correo</label>
    <br>
    <input type="email" name="data[email]">
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['email'])){
            echo $_SESSION['errores']['email'];
        }

    } ?></span>
    <br>
    <label for="password">Contraseña</label>
    <br>
    <input type="password" name="data[password]">
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['password'])){
            echo $_SESSION['errores']['password'];
        }

    } ?></span>
    <br>
    <br>
    <input type="submit" value="Enviar">

</form>