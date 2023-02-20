<h1>Carrito de la compra</h1>
<table>
    <tr>
            <td>Nombre</td>
            <td>Descripcion</td>
            <td>Precio</td>
            <td>Unidades</td>
            <td>Imagen</td>
    <tr>
    <?php 
    $total = 0;
    $total_unidades = 0;
    ?>
    <?php if(isset($productos)){?>
    <?php foreach($productos as $producto):?>
            <?php if(isset($_SESSION['carrito'][$producto['id']])){?>
                <td><?= $producto['nombre']?></td>
                <td><?= $producto['descripcion']?></td>
                <td><?= $producto['precio']?>€</td>
                <td><?= $_SESSION['carrito'][$producto['id']] ?></td>
                <?php $total += $producto['precio']*$_SESSION['carrito'][$producto['id']]; ?>
                <?php $total_unidades += $_SESSION['carrito'][$producto['id']];?>
                <td><img src="<?= "../images/".$producto['imagen']?>" width="100px"></td>
                <td>
                        <form action="Carrito/anadir_carrito" method="post">
                            <input type="hidden" name="stock" value="<?= $producto['stock']?>">
                            <input type="number" name="unidades" min="1" value="1">
                            <input type="hidden" name="cod" value="<?= $producto['id'] ?>">
                            <input type="submit" value="Añadir">
                        </form>
                </td>
                <td>
                    <form action="Carrito/borrar_elementos" method="post">
                        <input type="number" name="unidades" min="1" value="1">
                        <input type="hidden" name="cod" value="<?= $producto['id'] ?>">
                        <input type="submit" value="Eliminar">
                    </form>
                </td>
        </tr>
        <?php }?>
    <?php endforeach; ?>
    <?php }?>
</table>
<hr>
<?php echo "Total de productos en la cesta: ".$total_unidades; ?>
<br>
<?php echo "Precio final: ".$total."€"; ?>
<?php 
    if(!isset($_SESSION['total'])){
        $_SESSION['total'] = $total;
    }else{
        $_SESSION['total'] = $total;
    }
?>
<br>
<a href="Pedido/comprobarPedido">Realizar pedido</a>


<br>