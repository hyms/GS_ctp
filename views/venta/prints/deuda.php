<div style="width:793px; height:529px;">
    <div class="col-xs-12">
        <div class="row">
            <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?php echo "Pago de Deuda";?></strong></h3>
            <div class="text-right"><strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($deuda->time));?></div>
        </div>

        <div class="row">
            <div class="col-xs-5"><strong>Cliente: </strong><?php echo $orden->fkIdCliente->nombreNegocio; ?></div>
            <div class="col-xs-5"><strong>NitCi: </strong><?php echo $orden->fkIdCliente->nitCi; ?></div>
        </div>
        <div class="row">
            <div class="col-xs-5"><strong>Responsable: </strong><?php echo $orden->responsable; ?></div>
            <div class="col-xs-5"><strong>Telefono: </strong><?php echo $orden->telefono; ?></div>
        </div>

        <div class="row well well-sm" style="height:180px; border-color: #000000">
            <table class="table table-condensed">
                <thead><tr>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Nº"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Formato"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Nº Placas"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Colores"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Trabajo"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Pinza"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Resol."; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Costo"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Adicional"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?php echo "Total"; ?></th>
                </tr></thead>

                <tbody>
                <?php $i=0; foreach ($orden->ordenDetalles as $producto){ $i++;?>
                    <tr>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo $i;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo $producto->fkIdProductoStock->fkIdProducto->formato;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo $producto->cantidad; ?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo $producto->trabajo;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo $producto->pinza;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo $producto->resolucion;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo $producto->costo;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo $producto->adicional;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?php echo $producto->total;?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <strong>Total:  </strong><?= $num ?> Bs.
        </div>
        <div class="row">
            <div class="col-xs-5">
                <div class="row">
                    <div class="col-xs-11 well well-sm" style="border-color: #000000;">
                        <h5><strong>Deuda</strong></h5>
                        <div class="row col-xs-5"><strong>Cancel.:</strong> <?php echo $oldDeuda." Bs";?></div>
                        <div class="row col-xs-5"><strong>Saldo:</strong> <?php echo ($orden->montoVenta - $oldDeuda)." Bs";?></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 col-xs-offset-1">
                <div class="row">
                    <div class="col-xs-11 well well-sm" style="border-color: #000000;">
                        <h5><strong>Cancelado</strong></h5>
                        <div class="row col-xs-5"><strong>A/C:</strong> <?php echo $deuda->monto." Bs";?></div>
                        <div class="row col-xs-5"><strong>Saldo:</strong> <?php echo ($orden->montoVenta - ($oldDeuda+$deuda->monto))." Bs";?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
