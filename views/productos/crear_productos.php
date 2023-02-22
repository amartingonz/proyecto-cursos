<link rel="stylesheet" href="./css/style.css">
<h2>Crear Producto</h2>
<?php 
    if(isset($_SESSION['admin'])){
        $datos = $_SESSION['id_admin'];
    }else{
        $datos = $_SESSION['id_usuario'];
    }
?>
<form action="<?= $_ENV['BASE_URL']?>crear_producto" method="post" enctype="multipart/form-data">

    <label for="categoria">Categoria</label>
    <br>
    <select name="data[categoria]">
        <?php foreach($categorias as $categoria) {
                    echo "<option>".$categoria['nombre']."</option>";
            }
        ?>
    </select>
    <br>
    <label for="nombre">Nombre</label>
    <br>
    <input type="text" name="data[nombre]" pattern="[a-zA-Z]+" title="No se permiten caracteres raros ni etiquetas">
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['nombre'])){
            echo $_SESSION['errores']['nombre'];
        }
    }?></span>
    <br>
    <label for="descripcion">Descripcion</label>
    <br>
    <textarea type="text" name="data[descripcion]" pattern="[a-zA-Z]+" title="No se permiten caracteres raros ni etiquetas"></textarea>
    <span><?php if(isset($_SESSION['errores'])){
        if(isset($_SESSION['errores']['descripcion'])){
            echo $_SESSION['errores']['descripcion'];
        }
    } ?></span>
    <br>
    <label for="precio">Precio</label>
    <br>
    <input type="number" name="data[precio]" min="1">
    <br>
    <label for="stock">Stock</label>
    <br>
    <input type="number" name="data[stock]" min="1">
    <br>
    <label for="oferta">Oferta</label>
    <br>
    <select name="data[oferta]">
        <option value="0" selected>No</option>
        <option value="25">25%</option>
        <option value="50">50%</option>
    </select>
    <br>
    <label for="imagen">Imagen</label>
    <br>
    <input type="file" name="data[imagen]" required>
    <br>
    <input type="submit" value="Crear">
</form>
