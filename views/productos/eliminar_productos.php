<form action="<?= $_ENV['BASE_URL']?>eliminar_producto" method="post">

    <label for="nombre">Nombre</label>
    <select name="id">
        <?php foreach($productos as $producto) {
                    echo "<option value=".$producto['id'].">".$producto['nombre']."</option>";
            }
        ?>
    <input type="submit" value="Eliminar">
</form>