<?php
    $data->setPagination(false);
    $data = $data->getData();
    $total = 0;
?>
<h4 class="text-center">Reporte de Caja Chica</h4>
<div class="row table-responsive">
    <table class="table table-condensed" style="font-size: 10px; ">
        <thead><tr>
            <th style="border: 1px solid black; text-align: center;"><?php echo "NOMBRE"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "MONTO"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "DETALLE"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "Nro. FACTURA"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "Fecha"; ?></th>
        </tr></thead>

        <tbody>
        <?php foreach($data as $item){ ?>
            <tr>
                <td style="border: 0.6px solid black;"><?php echo $item->fkIdUser->nombre." ".$item->fkIdUser->apellido; ?></td>
                <td style="border: 0.6px solid black; text-align: right;"><?php $total=$total+$item->monto; echo $item->monto; ?></td>
                <td style="border: 0.6px solid black;"><?php echo $item->detalle; ?></td>
                <td style="border: 0.6px solid black;"><?php echo $item->obseraciones; ?></td>
                <td style="border: 0.6px solid black;"><?php echo $item->fechaRegistro; ?></td>
            </tr>
        <?php }?>
        <tr>
            <td><strong>Totales</strong></td>
            <td style="border: 0.6px solid black; text-align: right;"><?php echo $total;?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <!--   </div> -->
</div>
