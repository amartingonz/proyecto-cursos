<h2>MIS PEDIDOS</h2>
<table>
    <tr>
            <td>Id</td>
            <td>Provincia</td>
            <td>Localidad</td>
            <td>Direccion</td>
            <td>Coste</td>
            <td>Fecha</td>
            <td>Hora</td>
    <tr>
    <?php if(isset($pedidos)){?>
        <?php foreach($pedidos as $pedido):?>
                    <td><?= $pedido['id']?></td>
                    <td><?= $pedido['provincia']?></td>
                    <td><?= $pedido['localidad']?></td>
                    <td><?= $pedido['direccion']?></td>
                    <td><?= $pedido['coste']?>€</td>
                    <td><?= $pedido['fecha']?></td>
                    <td><?= $pedido['hora']?></td>
        </tr>
        <?php endforeach; ?>
    <?php }?>
</table>
<hr>
<br>