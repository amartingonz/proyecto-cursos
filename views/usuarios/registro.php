<link rel="stylesheet" href="./css/style.css">
<!-- FORMULARIO DE REGISTRO -->

<h2>Registrate</h2>

<form action="<?= $_ENV['BASE_URL']?>usuarios_registrar" method="post">

    <label for="nombre">Nombre</label>
    <input type="text" name="data[nombre]">
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['nombre'])){
            echo $_SESSION['errores']['nombre'];
        }

    } ?></span>
    <br>
    <label for="apellidos">Apellidos</label>
    <input type="text" name="data[apellidos]" >
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['apellidos'])){
            echo $_SESSION['errores']['apellidos'];
        }

    } ?></span>
    <br>
    <label for="email">Email</label>
    <input type="email" name="data[email]" >
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['email'])){
            echo $_SESSION['errores']['email'];
        }

    } ?></span>
    <br>
    <label for="password">Contraseña</label>
    <input type="password" name="data[password]" >
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['password'])){
            echo $_SESSION['errores']['password'];
        }

    } ?></span>
    <br>
    <input type="submit" value="Registrar">

</form>

