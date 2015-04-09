<?php
    $data =$ventas->searchCliente('correlativo Asc','estado!=1');
    $data->setPagination(false);
    $data = $data->getData();
    $fecha = "";
    $fechaend = "";
    $sf = 0;
    foreach($data as $key => $item) {
        if ($key == 0)
            $fecha = date("d-m-Y", strtotime($item->fechaVenta));
        if ((count($data) - 1) == $key)
            $fechaend = date("d-m-Y", strtotime($data[$key]->fechaVenta));
        if ($item->tipoVenta==1) {
                $sf = 1;
        }
    }
    $totalsaldo = 0;
    $totalCobrado = 0;
    $totalTotal = 0;
    $totalPlacas = 0;
?>
<h4 class="text-center"><strong>Reporte de Movimientos</strong></h4>
<h5 class="text-center"><strong>Fecha:</strong> <?php echo ($fecha==$fechaend)?$fecha:($fecha." a ".$fechaend); ?></h5>
<div class="row table-responsive">
    <table class="table table-condensed" style="font-size: 10px; ">
        <thead><tr>
            <?php if($sf==1){ ?>
                <th style="border: 1px solid black; text-align: center;"><?php echo "ORDEN"; ?></th>
            <?php } ?>
            <th style="border: 1px solid black; text-align: center;"><?php echo "CODIGO"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "CLIENTE"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "RESPONSABLE"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "TRABAJO"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "PLACA"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "CANT"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "COSTO"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "Q/ARM."; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "TOTAL"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "DESC"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "COBRAR"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "CANCEL"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "SALDO"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "FACT"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "OBS."; ?></th>
        </tr></thead>

        <tbody>
        <?php foreach($data as $item){ ?>
            <?php $count = count($item->detalleServicios); ?>
            <?php foreach($item->detalleServicios as $key => $detalle){ ?>
                <tr>
                    <?php if($key==0){ ?>
                        <?php if($sf==1){ ?>
                            <td style="border: 0.6px solid black;" rowspan="<?php echo $count;?>"><?php echo $item->correlativo; ?></td>
                        <?php } ?>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo $count;?>"><?php echo $item->codigoServicio; ?></td>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo $count;?>"><?php echo $item->fkIdCliente["nombreNegocio"]; ?></td>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo $count;?>"><?php echo $item->responsable; ?></td>
                    <?php } ?>

                    <td style="border: 0.6px solid black;"><?php echo $detalle->trabajo; ?></td>
                    <td style="border: 0.6px solid black;"><?php echo $detalle->fkIdProductoStock->fkIdProducto->color; ?></td>
                    <td style="border: 0.6px solid black; text-align: right;"><?php echo $detalle->cantidad; $totalPlacas=$totalPlacas+$detalle->cantidad; ?></td>
                    <td style="border: 0.6px solid black; text-align: right;"><?php echo $detalle->costo; ?></td>
                    <td style="border: 0.6px solid black; text-align: right;"><?php echo $detalle->adicional; ?></td>
                    <td style="border: 0.6px solid black; text-align: right;"><?php echo $detalle->total; ?></td>
                    <?php if($key==0){ ?>
                        <td style="border: 0.6px solid black; text-align: right;" rowspan="<?php echo $count;?>"><?php echo $item->montoDescuento; ?></td>
                        <td style="border: 0.6px solid black; text-align: right;" rowspan="<?php echo $count;?>"><?php echo $item->montoVenta; $totalTotal=$totalTotal+$item->montoVenta;?></td>
                        <td style="border: 0.6px solid black; text-align: right;" rowspan="<?php echo $count;?>"><?php $item->montoPagado = SGServicioVenta::montoPagado($item); echo $item->montoPagado; $totalCobrado=$totalCobrado+$item->montoPagado;?></td>
                        <td style="border: 0.6px solid black; text-align: right;" rowspan="<?php echo $count;?>"><?php echo (($item->montoVenta-$item->montoPagado)>0)?($item->montoVenta-$item->montoPagado):""; $totalsaldo=$totalsaldo+($item->montoVenta-$item->montoPagado);?></td>
                        <td style="border: 0.6px solid black; text-align: center;" rowspan="<?php echo $count;?>"><?php echo $item->fkIdFactura["codigo"]; ?></td>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo $count;?>"><?php echo $item->obseracionesCaja; ?></td>
                    <?php } ?>
                </tr>
            <?php }?>
        <?php }?>
        <tr>
            <?php if($sf==1){ ?>
                <td></td>
            <?php } ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Totales</strong></td>
            <td style="border: 0.6px solid black; text-align: right;"><?php echo $totalPlacas; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 0.6px solid black; text-align: right;"><?php echo $totalTotal;?></td>
            <td style="border: 0.6px solid black; text-align: right;"><?php echo $totalCobrado;?></td>
            <td style="border: 0.6px solid black; text-align: right;"><?php echo $totalsaldo;?></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <!--   </div> -->
</div>
