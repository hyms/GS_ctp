<div class="row">
    <div style="width:593px; position: relative; float: left;">
        <div class="col-xs-12">
            <div class="row">
                <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?= "Orden de Trabajo";?></strong></h3>
                <h4 class="text-right"><strong><?= ($orden->cfSF==0)?$orden->codigoServicio:" "; ?></strong></h4>
                <div class="row col-xs-12">
                    <div class="col-xs-offset-4 col-xs-3 text-center"><small><?= $orden->fkIdSucursal->nombre;?></small></div>
                    <div class="text-right"><strong><?= "FECHA:";?></strong> <?= date("d-m-Y",strtotime($orden->fechaCobro));?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-7"><strong><?= "CLIENTE:";?></strong> <?= $orden->fkIdCliente->nombreNegocio."(".$orden->responsable.")";?></div>
                <div class="col-xs-3"><strong><?= "NIT:";?></strong> <?= $orden->fkIdCliente->nitCi;?></div>
            </div>

            <div class="row well well-sm" style="height:170px; font-size: 11px; border-color: #000; background-color: #fff">
                <table class="table table-hover table-condensed">
                    <thead><tr>
                        <th><?= "Nº"; ?></th>
                        <th><?= "Formato"; ?></th>
                        <th><?= "Cant."; ?></th>
                        <th><?= "Colores"; ?></th>
                        <th><?= "Trabajo"; ?></th>
                        <th><?= "Pinza"; ?></th>
                        <th><?= "Resol."; ?></th>
                        <th><?= "Costo"; ?></th>
                        <th><?= "Adicional"; ?></th>
                        <th><?= "Total"; ?></th>
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
                                <?= $producto->costo;?>
                            </td>
                            <td>
                                <?= $producto->adicional;?>
                            </td>
                            <td>
                                <?= $producto->total;?>
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
                    <div class="row col-xs-12" style="font-size: 10px"><strong>Diseñador/a:</strong> <?php //$orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></div>
                    <div class="row col-xs-12" style="font-size: 10px"><strong>Obs:</strong> <?= $orden->observaciones;?></div>
                    <div class="row col-xs-12" style="font-size: 10px"><strong>Cajer@:</strong> <?php //$orden->fkIdUserV->nombre." ".$orden->fkIdUserV->apellido;?></div>
                    <div class="row col-xs-12" style="font-size: 10px"><strong>Obs:</strong> <?= $orden->observacionesCaja;?></div>
                </div>

            </div>
        </div>
    </div>
    <div style="width:123px; position: relative; float: right;">
        <div class="row" style="font-size: 11px">
            <div class="col-xs-12 row text-center"><h4><strong><?= $orden->correlativo;?></strong></h4></div>
            <div class="col-xs-12 row text-center" style="font-size: 8px"><?= $orden->fkIdSucursal->nombre;?></div>
            <div class="col-xs-12 row text-center"><h4><strong><?= $orden->codigoServicio;?></strong></h4></div>
            <div class="col-xs-12 row"><span class="row"><strong><?= "CLIENTE:";?></strong> <span class="col-xs-12"><?= $orden->fkIdCliente->nombreNegocio;?></span></div>
            <div class="col-xs-12 row"><span class="row"><strong><?= "RESP:";?></strong> <span class="col-xs-12"><?= $orden->responsable;?></span></div>
            <div class="col-xs-12 row"><span class="row"><strong><?= "FECHA:";?></strong> <span class="col-xs-12"><?= date("d-m-Y",strtotime($orden->fechaCobro));?></span></span></div>
            <div class="col-xs-12 row" style="font-size: 10px"><strong>Diseñador/a:</strong> <?php //$orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></div>
            <div class="col-xs-12 row">
                <?php foreach ($orden->ordenDetalles as $producto){ ?>
                    <div class="col-xs-12" style="border: 1.5px solid;">
                        <?= $producto->fkIdProductoStock->fkIdProducto->formato;?> /
                        <?= $producto->cantidad; ?> /
                        <?= (($producto->C)?"C ":"").(($producto->M)?"M ":"").(($producto->Y)?"Y ":"").(($producto->K)?"K ":"");?>
                        <br>
                        <?= $producto->trabajo;?> /
                        <?= $producto->pinza;?> /
                        <?= $producto->resolucion;?>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
