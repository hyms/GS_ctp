<div class="hidden-print">
    <?php echo CHtml::link('<span class="glyphicon glyphicon-print"></span>', '#', array("class"=>"btn btn-default","id"=>"print")); ?>
    <?php echo CHtml::link('<span class="glyphicon glyphicon-save"></span>', array("ctp/previewDay","excel"=>true), array("class"=>"btn btn-default",'id'=>"print","title"=>"Descargar Excel")); ?>
</div>

<div style="width:793px; height:529px;">
    <?php
    if(!empty($tabla)) {
        $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        ?>
        <p class="text-center"><strong><?php echo "REPORTE DE VENTAS DEL DIA" ?></strong></p>
        <p class="text-right"><?php echo "La Paz, " . $dias[date('w', strtotime($tabla[0]->fechaOrden))] . " " . date('d', strtotime($tabla[0]->fechaOrden)) . " de " . $meses[date('n', strtotime($tabla[0]->fechaOrden)) - 1] . " del " . date('Y', strtotime($tabla[0]->fechaOrden)); ?></p>
        <table class="table table-hover table-condensed" style="font-size: 9px">
            <thead>
            <tr>
                <th>Nº</th>
                <th>Codigo Orden</th>
                <th>Cliente</th>
                <th>Cod. Prod.</th>
                <th>Detalle del Producto</th>
                <th>Cant.</th>
                <th>Precio</th>
                <th>T/A</th>
                <th>Total</th>
                <th>Importe</th>
                <th>Creditos</th>
                <th>Fact.</th>
                <th>Obs.</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            $total = 0;
            $importe = 0;
            $creditos = 0;
            $adicional = 0;
            foreach ($tabla as $item) {
                $temp = count($item->detalleCTPs);
                foreach ($item->detalleCTPs as $producto) {
                    $i++;
                    $temp--;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $item->codigo; ?></td>
                        <td><?php echo $item->idCliente0->apellido . " " . $item->idCliente0->nombre; ?></td>
                        <td><?php echo $producto->idAlmacenProducto0->idProducto0->codigo; ?></td>
                        <td>
                            <?php
                            echo $producto->idAlmacenProducto0->idProducto0->material
                                . " " . $producto->idAlmacenProducto0->idProducto0->color
                                . " " . $producto->idAlmacenProducto0->idProducto0->detalle
                                . " " . $producto->idAlmacenProducto0->idProducto0->marca;
                            ?>
                        </td>
                        <td><?php echo $producto->nroPlacas; ?></td>
                        <td><?php echo ($producto->nroPlacas * $producto->costo); ?></td>
                        <td><?php echo $producto->costoAdicional;
                            $adicional = $adicional + $producto->costoAdicional; ?></td>
                        <td><?php echo $producto->costoTotal;
                            $total = $total + $producto->costoTotal; ?></td>
                        <td><?php echo ($item->estado == 1) ? (($temp == 0) ? ($item->montoPagado - $item->montoCambio) : 0) : (($item->estado == 2) ? (($temp == 0) ? $item->montoPagado : 0) : 0);
                            ($item->estado == 1) ? (($temp == 0) ? ($importe = $importe + ($item->montoPagado - $item->montoCambio)) : 0) : (($item->estado == 2) ? (($temp == 0) ? ($importe = $importe + $item->montoPagado) : 0) : 0); ?></td>
                        <td><?php echo ($item->estado == 2) ? (($temp == 0) ? ($item->montoCambio * (-1)) : 0) : 0;
                            ($item->estado == 2) ? (($temp == 0) ? ($creditos = $creditos + ($item->montoCambio * (-1))) : 0) : 0; ?></td>
                        <td><?php echo $item->factura; ?></td>
                        <td><?php echo $item->obs; ?></td>
                    </tr>
                <?php
                }
            }
            ?>
            <tr>
                <td colspan="5" class="text-right"><strong>Totales</strong></td>
                <td></td>
                <td></td>
                <td><strong><?php echo $adicional; ?></strong></td>
                <td><strong><?php echo $total; ?></strong></td>
                <td><strong><?php echo $importe; ?></strong></td>
                <td><strong><?php echo $creditos; ?></strong></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

    <?php
    }
    else
        echo "No existen registros";
    ?>
</div>