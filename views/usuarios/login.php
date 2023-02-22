<link rel="stylesheet" href="./css/style.css">
<!-- FORMULARIO DE LOGIN -->
<h2>Identificate</h2>
<form action="<?= $_ENV['BASE_URL']?>usuarios_loguear" method="post">

    <label for="email">Email</label>
    <input type="email" name="data[email]">
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['email'])){
            echo $_SESSION['errores']['email'];
        }
    } ?></span>
    <br>
    <label for="password">Contraseña</label>
    <input type="password" name="data[password]" required>
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['password'])){
            echo $_SESSION['errores']['password'];
        }
    } ?></span>
    <br>
    <input type="submit" value="Entrar">
</form>