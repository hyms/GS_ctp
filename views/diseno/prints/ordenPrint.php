<div style="width:376px;height:306px; position: relative; float: left;">
    <div class="col-xs-12">
        <div class="row">
            <div class="row col-xs-12">
                <h3 class="col-xs-5 text-center"><?= $orden->fkIdSucursal->nombre;?></h3>
                <div class="text-right"><strong><?= "FECHA:";?></strong> <?= date("d-m-Y / H:i",strtotime($orden->fechaCobro));?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-7"><strong><?= "CLIENTE:";?></strong> <?= $orden->fkIdCliente->nombreNegocio."(".$orden->responsable.")";?></div>
            <div class="col-xs-3"><strong><?= "NIT:";?></strong> <?= $orden->fkIdCliente->nitCi;?></div>
        </div>

        <div class="row well well-sm" style="height:170px; font-size: 11px; border-color: #000; background-color: #fff">
            <table class="table table-hover table-condensed" style="font-size: 12px">
                <thead><tr>
                    <th><?= "Nº"; ?></th>
                    <th><?= "Formato"; ?></th>
                    <th><?= "Cant."; ?></th>
                    <th><?= "Colores"; ?></th>
                    <th><?= "Trabajo"; ?></th>
                    <th><?= "Pinza"; ?></th>
                    <th><?= "Resol."; ?></th>
                    <th><?= "Adicional"; ?></th>
                </tr></thead>

                <tbody>
                <?php foreach ($orden->ordenDetalles as $key => $producto){ ;?>
                    <tr>
                        <td>
                            <?= ($key+1);?>
                        </td>
                        <td>
                            <?= $producto->fkIdProductoStock->fkIdProducto->formato;?>
                        </td>
                        <td class="col-xs-1">
                            <?= $producto->cantidad; ?>
                        </td>
                        <td>
                            <?= (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                        </td>
                        <td>
                            <?= $producto->trabajo;?>
                        </td>
                        <td>
                            <?= $producto->pinza;?>
                        </td>
                        <td>
                            <?= $producto->resolucion;?>
                        </td>
                        <td>
                            <?= $producto->adicional;?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <!--   </div> -->
        </div>

        <div class="row">
            <div class="col-xs-4">
                <div class="row">
                    <div class="col-xs-11 well well-sm" style="border-formato: #000000;">
                        <br><br><br>
                        <div class="text-center" style="font-size: 11px"><?= "firma";?></div>
                        <div><?= "Nombre: ".$orden->responsable?></div>
                        <div class="text-center" style="font-size: 10px"><small><?= "Autorizo la elaboración de la presente orden";?></small></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-xs-offset-1">
                <div class="row col-xs-12" style="border: 1.5px solid; border-formato: #000000;"><strong>Total:</strong>
                    <?= $orden->montoVenta." Bs. <span style=\"font-size:11px\">(".$monto.")</span>";
                    ?>
                </div>
                <?php if($orden->montoDescuento>0){?>
                    <div class="row col-xs-5" style="font-size: 10px"><strong>Aut. por:</strong> <?= ($orden->tipoPago==1)?CHtml::encode(($orden->autorizado==0)?'Erick Paredes':'Miriam Martinez'):""?></div>
                    <div class="row col-xs-5" style="font-size: 10px"><strong>Desc:</strong> <?= $orden->montoDescuento." Bs.";?></div>
                <?php }?>
                <?php if($orden->tipoPago){?>
                    <div class="row col-xs-5" style="font-size: 12px"><strong>A/C:</strong> <?= $orden->fkIdMovimientoCaja->monto." Bs.";?></div>
                    <div class="row col-xs-5" style="font-size: 12px"><strong>Saldo:</strong> <?= ((($orden->montoVenta-$orden->fkIdMovimientoCaja->monto)>0)?($orden->montoVenta-$orden->fkIdMovimientoCaja->monto):"0")." Bs.";?></div>
                    <div class="row col-xs-5" style="font-size: 10px"><strong>Venta a Credito</strong></div>
                    <div class="row col-xs-5" style="font-size: 10px"><strong>Plazo:</strong> <?= date("d-m-Y",strtotime($orden->fechaPlazo));?></div>
                <?php } ?>
                <div class="row col-xs-12" style="font-size: 10px"><strong>Diseñador/a:</strong> <?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></div>
                <div class="row col-xs-12" style="font-size: 10px"><strong>Obs:</strong> <?= $orden->observaciones;?></div>
                <div class="row col-xs-12" style="font-size: 10px"><strong>Cajer@:</strong> <?= $orden->fkIdUserV->nombre." ".$orden->fkIdUserV->apellido;?></div>
                <div class="row col-xs-12" style="font-size: 10px"><strong>Obs:</strong> <?= $orden->observacionesCaja;?></div>
            </div>

        </div>
    </div>
</div>
