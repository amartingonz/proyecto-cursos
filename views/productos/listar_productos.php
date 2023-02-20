
<h2>Productos</h2>
<table>
    <tr>
            <td>Categoria_ID</td>
            <td>Nombre</td>
            <td>Descripcion</td>
            <td>Precio</td>
            <td>Stock</td>
            <td>Imagen</td>
    <tr>
    <?php if(isset($productos)){?>
    <?php foreach($productos as $producto):?>
                <?php if($producto['stock'] != 0):?>
                    <td><?= $producto['categoria_id']?></td>
                    <td><?= $producto['nombre']?></td>
                    <td><?= $producto['descripcion']?></td>
                    <td><?= $producto['precio']?>€</td>
                    <td><?= $producto['stock']?></td>
                    <td><img src="<?= "images/".$producto['imagen']?>" width="100px"></td>
                    <td>
                        <form action="Carrito/anadir_carrito" method="post">
                            <input type="hidden" name="stock" value="<?= $producto['stock']?>">
                            <input type="number" name="unidades" min="1" value="1" max="<?= $producto['stock']?>">
                            <input type="hidden" name="cod" value="<?= $producto['id'] ?>">
                            <input type="submit" value="Añadir">
                        </form>
                    </td>
                </tr>
                <?php endif;?>
    <?php endforeach; ?>
    <?php }?>
</table>
<hr>
<br>