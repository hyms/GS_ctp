<div style="width:793px; height:529px;">
    <div class="col-xs-12">
        <div class="row">
            <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?="Pago de Deuda";?></strong></h3>
            <div class="text-right"><strong><?="FECHA:";?></strong> <?=date("d-m-Y",strtotime($deuda->time));?></div>
        </div>

        <div class="row">
            <div class="col-xs-5"><strong>Cliente: </strong><?= (!empty($orden->fk_idCliente))?$orden->fkIdCliente->nombreNegocio:""; ?></div>
            <div class="col-xs-5"><strong>NitCi: </strong><?=(!empty($orden->fk_idCliente))?$orden->fkIdCliente->nitCi:""; ?></div>
        </div>
        <div class="row">
            <div class="col-xs-5"><strong>Responsable: </strong><?=$orden->responsable; ?></div>
            <div class="col-xs-5"><strong>Telefono: </strong><?=$orden->telefono; ?></div>
        </div>

        <div class="row well well-sm" style="height:180px; border-color: #000000">
            <table class="table table-condensed">
                <thead><tr>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Nº"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Formato"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Nº Placas"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Colores"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Trabajo"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Pinza"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Resol."; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Costo"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Adicional"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?="Total"; ?></th>
                </tr></thead>

                <tbody>
                <?php $i=0; foreach ($orden->ordenDetalles as $producto){ $i++;?>
                    <tr>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=$i;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=$producto->fkIdProductoStock->fkIdProducto->formato;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=$producto->cantidad; ?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=(($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=$producto->trabajo;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=$producto->pinza;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=$producto->resolucion;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=$producto->costo;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=$producto->adicional;?>
                        </td>
                        <td style="font-size:12px; padding-top: 4px;">
                            <?=$producto->total;?>
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
                    <div class="col-xs-11 well well-sm" style="border-color: #000000; background-color: #FFFFFF">
                        <h5><strong>Deuda</strong></h5>
                        <div class="row col-xs-5"><strong>Cancel.:</strong> <?=$oldDeuda." Bs";?></div>
                        <div class="row col-xs-5"><strong>Saldo:</strong> <?=($orden->montoVenta - $oldDeuda)." Bs";?></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 col-xs-offset-1">
                <div class="row">
                    <div class="col-xs-11 well well-sm" style="border-color: #000000; background-color: #FFFFFF">
                        <h5><strong>Cancelado</strong></h5>
                        <div class="row col-xs-5"><strong>A/C:</strong> <?=$deuda->monto." Bs";?></div>
                        <div class="row col-xs-5"><strong>Saldo:</strong> <?=($orden->montoVenta - ($oldDeuda+$deuda->monto))." Bs";?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
