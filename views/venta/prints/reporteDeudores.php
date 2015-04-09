<?php
    $data =$pagos->search(null,'fk_idServicioVenta');
    $data->setPagination(false);
    $data = $data->getData();
    $totalsaldo = 0;
    $totalCobrado = 0;
    $totalTotal = 0;
?>
<h4 class="text-center">Reporte de Pago de Saldos</h4>
<div class="row table-responsive">
    <table class="table table-condensed" style="font-size: 10px; ">
        <thead><tr>
            <th style="border: 1px solid black; text-align: center;"><?php echo "FECHA"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "ORDEN"; ?></th>
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
            <th style="border: 1px solid black; text-align: center;"><?php echo "FECHA"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "ACUENTA"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "CANCEL"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "SALDO"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "FACT"; ?></th>
            <th style="border: 1px solid black; text-align: center;"><?php echo "OBS."; ?></th>
        </tr></thead>

        <tbody>
        <?php foreach($data as $tmp){ ?>
            <?php
            $item = $tmp->fkIdServicioVenta;

            $count = count($item->detalleServicios);
            $countA = count($item->deudasServicioVentas);
            if($countA>$count)
                $c=$countA;
            else
                $c=$count;

            $i=0;
            ?>
            <?php for($i; $i<=$c;$i++){ ?>
                <tr>
                    <?php if($i==0){ ?>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo ($c+1);?>"><?php echo $item->fechaVenta; ?></td>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo ($c+1);?>"><?php echo $item->correlativo; ?></td>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo ($c+1);?>"><?php echo $item->codigoServicio; ?></td>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo ($c+1);?>"><?php echo $item->fkIdCliente["nombreNegocio"]; ?></td>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo ($c+1);?>"><?php echo $item->responsable; ?></td>
                    <?php } ?>
                    <?php if($i<$count){?>
                        <td style="border: 0.6px solid black;"><?php echo $item->detalleServicios[$i]->trabajo; ?></td>
                        <td style="border: 0.6px solid black;"><?php echo $item->detalleServicios[$i]->fkIdProductoStock->fkIdProducto->color; ?></td>
                        <td style="border: 0.6px solid black; text-align: right;"><?php echo $item->detalleServicios[$i]->cantidad; ?></td>
                        <td style="border: 0.6px solid black; text-align: right;"><?php echo $item->detalleServicios[$i]->costo; ?></td>
                        <td style="border: 0.6px solid black; text-align: right;"><?php echo $item->detalleServicios[$i]->adicional; ?></td>
                        <td style="border: 0.6px solid black; text-align: right;"><?php echo $item->detalleServicios[$i]->total; ?></td>
                    <?php }else{ ?>
                        <td style="border: 0.6px solid black;"></td>
                        <td style="border: 0.6px solid black;"></td>
                        <td style="border: 0.6px solid black;"></td>
                        <td style="border: 0.6px solid black;"></td>
                        <td style="border: 0.6px solid black;"></td>
                        <td style="border: 0.6px solid black;"></td>
                    <?php } ?>
                    <?php if($i==0){ ?>
                        <td style="border: 0.6px solid black; text-align: right;" rowspan="<?php echo ($c+1);?>"><?php echo $item->montoDescuento; ?></td>
                        <td style="border: 0.6px solid black; text-align: right;" rowspan="<?php echo ($c+1);?>"><?php echo $item->montoVenta; $totalTotal=$totalTotal+$item->montoVenta;?></td>
                    <?php } ?>
                    <?php if($i<=$countA){ ?>
                        <?php if($i==0){ ?>
                            <td style="border: 0.6px solid black; text-align: right;"><?php echo $item->fechaVenta;?></td>
                            <td style="border: 0.6px solid black; text-align: right;"><?php echo $item->deudasServicioVentas[$i]->montoPagado;?></td>
                        <?php }else{ ?>
                            <td style="border: 0.6px solid black; text-align: right;"><?php echo $item->deudasServicioVentas[$i-1]->fecha;?></td>
                            <td style="border: 0.6px solid black; text-align: right;"><?php echo $item->deudasServicioVentas[$i-1]->acuenta;?></td>
                        <?php } ?>
                    <?php }else{ ?>
                        <td style="border: 0.6px solid black;"></td>
                        <td style="border: 0.6px solid black;"></td>
                    <?php } ?>
                    <?php if($i==0){ ?>
                        <td style="border: 0.6px solid black; text-align: right;" rowspan="<?php echo ($c+1);?>"><?php $item->montoPagado = SGServicioVenta::montoPagado($item,true); echo $item->montoPagado; $totalCobrado=$totalCobrado+$item->montoPagado;?></td>
                        <td style="border: 0.6px solid black; text-align: right;" rowspan="<?php echo ($c+1);?>"><?php echo (($item->montoVenta-$item->montoPagado)>0)?($item->montoVenta-$item->montoPagado):""; $totalsaldo=$totalsaldo+($item->montoVenta-$item->montoPagado);?></td>
                        <td style="border: 0.6px solid black; text-align: center;" rowspan="<?php echo ($c+1);?>"><?php echo $item->fkIdFactura["codigo"]; ?></td>
                        <td style="border: 0.6px solid black;" rowspan="<?php echo ($c+1);?>"><?php echo $item->obseracionesCaja; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        <?php }?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Totales</strong></td>
            <td style="border: 0.6px solid black;"><?php echo $totalTotal;?></td>
            <td></td>
            <td></td>
            <td style="border: 0.6px solid black;"><?php echo $totalCobrado;?></td>
            <td style="border: 0.6px solid black;"><?php echo $totalsaldo;?></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <!--   </div> -->
</div>