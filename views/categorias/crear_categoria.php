
<h2>Crear Categoria</h2>
<form action="<?= $_ENV['BASE_URL']?>crear_categoria" method="post">
            <input type="text" name="nombre">
            <span><?php if(isset($_SESSION['errores'])){
                if(isset($_SESSION['errores']['nombre'])){
                    echo $_SESSION['errores']['nombre'];
                }
            } ?></span>
            <br>
            <br>
            <input type="submit" value="Crear">
</form>
