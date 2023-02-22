
<h2>Crear Pedido</h2>

<?php 

    if(isset($_SESSION['admin'])){
        $id = $_SESSION['id_admin'];
    }
    if(isset($_SESSION['usuario'])){
        $id = $_SESSION['id_usuario'];
    }
    if(isset($_SESSION['total'])){
        $total = $_SESSION['total'];
    }
?>


<form action="<?= $_ENV['BASE_URL']?>crear_pedido" method="post">

    <input type="hidden" name="data[usuario_id]" value="<?= $id ?>">
    <label for="provincia">Provincia</label>
    <br>
    <input type="text" name="data[provincia]" pattern="[a-zA-Z]+" title="No se permiten caracteres raros ni etiquetas">
    <span><?php if(isset($_SESSION['errores'])){
                if(isset($_SESSION['errores']['provincia'])){
                    echo $_SESSION['errores']['provincia'];
                }
            } ?></span>
    <br>
    <label for="localidad">Localidad</label>
    <br>
    <input type="text" name="data[localidad]" pattern="[a-zA-Z]+" title="No se permiten caracteres raros ni etiquetas">
    <span><?php if(isset($_SESSION['errores'])){
                if(isset($_SESSION['errores']['localidad'])){
                    echo $_SESSION['errores']['localidad'];
                }
            } ?></span>
    <br>
    <label for="direccion">Dirección</label>
    <br>
    <input type="text" name="data[direccion]" pattern="^[a-zA-Z0-9\s\.\#\-]+$" title="No se permiten caracteres raros ni etiquetas">
    <span><?php if(isset($_SESSION['errores'])){
                if(isset($_SESSION['errores']['direccion'])){
                    echo $_SESSION['errores']['direccion'];
                }
            } ?></span>
    <br>
    <label for="coste">Coste</label>
    <br>
    <?php echo $total."€"; ?>
    <input type="hidden" name="data[coste]" value="<?= $total ?>">
    <br>
    
    <input type="submit" value="Procesar">

</form>

