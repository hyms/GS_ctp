<div class="row" style="color: #000000">
    <div style="width:593px; position: relative; float: left;">
        <div class="col-xs-12">
            <div class="row">
                <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?= "Orden de Trabajo";?></strong></h3>
                <h4 class="text-right"><strong><?= ($orden->cfSF==0)?$orden->codigoServicio:" "; ?></strong></h4>
                <div class="row col-xs-12">
                    <div class="col-xs-offset-4 col-xs-3 text-center"><small><?= $orden->fkIdSucursal->nombre;?></small></div>
                    <div class="text-right"><strong><?= "FECHA:";?></strong> <?= (((empty($orden->fechaCobro))?date("d-m-Y / H:i"):date("d-m-Y / H:i",strtotime($orden->fechaCobro))));?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-7"><strong><?= "CLIENTE:";?></strong><span class="text-capitalize"> <?= ((!empty($orden->fk_idCliente))?$orden->fkIdCliente->nombreNegocio:$orden->responsable)." - ".$orden->telefono; ?></span></div>
                <div class="col-xs-3"><strong><?= "NIT:";?></strong> <?= (!empty($orden->fk_idCliente))?$orden->fkIdCliente->nitCi:"";?></div>
            </div>

            <div class="row well well-sm" style="height:170px; border-color: #000; background-color: #fff; color: #000">
                <table class="table table-condensed">
                    <thead><tr>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Nº"; ?></th>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Formato"; ?></th>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Cant."; ?></th>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Colores"; ?></th>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Trabajo"; ?></th>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Pinza"; ?></th>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Resol."; ?></th>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Costo"; ?></th>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Adic."; ?></th>
                        <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Total"; ?></th>
                    </tr></thead>

                    <tbody>
                    <?php foreach ($orden->ordenDetalles as $key => $producto){ ;?>
                        <tr>
                            <td style="font-size:12px; padding-top: 4px;">
                                <?= ($key+1);?>
                            </td>
                            <td style="font-size:12px; padding-top: 4px;">
                                <?= $producto->fkIdProductoStock->fkIdProducto->formato;?>
                            </td>
                            <td style="font-size:12px; padding-top: 4px;">
                                <?= $producto->cantidad; ?>
                            </td>
                            <td style="font-size:12px; padding-top: 4px;">
                                <?= (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                            </td>
                            <td style="font-size:12px; padding-top: 4px;">
                                <?= $producto->trabajo;?>
                            </td>
                            <td style="font-size:12px; padding-top: 4px;">
                                <?= $producto->pinza;?>
                            </td>
                            <td style="font-size:12px; padding-top: 4px;">
                                <?= $producto->resolucion;?>
                            </td>
                            <td style="font-size:12px; padding-top: 4px;">
                                <?= $producto->costo;?>
                            </td>
                            <td style="font-size:12px; padding-top: 4px;">
                                <?= $producto->adicional;?>
                            </td>
                            <td style="font-size:12px; padding-top: 4px;">
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
                        <div class="col-xs-11 well well-sm" style="border-color: #000000; background-color: #FFFFFF">
                            <br><br><br>
                            <div class="text-center" style="font-size: 11px"><?= "firma";?></div>
                            <div class="row col-xs-12"><span class="text-capitalize"><?= "Nombre: ".$orden->responsable."  "?></span><strong><?= $orden->correlativo?></strong></div>
                            <div class="text-center" style="font-size: 10px"><small><?= "Autorizo la elaboración de la presente orden";?></small></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xs-offset-1">
                    <div class="row col-xs-12" style="border: 1.5px solid; border-formato: #000000;"><strong>Total:</strong>
                        <?php if(is_numeric($orden->montoVenta)){ ?><?= $orden->montoVenta?>Bs. <span style="font-size:11px"><?= $monto ?></span> <?php } ?>
                    </div>
                    <?php if($orden->montoDescuento>0){?>
                        <div class="row col-xs-5" style="font-size: 10px"><strong>Desc:</strong> <?= $orden->montoDescuento." Bs.";?></div>
                    <?php }?>
                    <?php if($orden->tipoPago){?>
                        <div class="row col-xs-5" style="font-size: 12px"><strong>A/C:</strong> <?= $orden->fkIdMovimientoCaja->monto." Bs.";?></div>
                        <div class="row col-xs-5" style="font-size: 12px"><strong>Saldo:</strong> <?= ((($orden->montoVenta-$orden->fkIdMovimientoCaja->monto)>0)?($orden->montoVenta-$orden->fkIdMovimientoCaja->monto):"0")." Bs.";?></div>
                        <div class="row col-xs-5" style="font-size: 10px"><strong>Venta a Credito</strong></div>
                        <div class="row col-xs-5" style="font-size: 10px"><strong>Plazo:</strong> <?= date("d-m-Y",strtotime($orden->fechaPlazo));?></div>
                    <?php } ?>
                    <div class="row col-xs-12" style="font-size: 10px"><strong>Diseñador/a:</strong> <span class="text-capitalize"><?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></span></div>
                    <div class="row col-xs-12" style="font-size: 10px"><strong>Obs:</strong> <?= $orden->observaciones;?></div>
                    <div class="row col-xs-12" style="font-size: 10px"><strong>Cajer@:</strong> <span class="text-capitalize"><?= ((empty($orden->fkIdUserV))?Yii::$app->user->identity->nombre." ".Yii::$app->user->identity->apellido:$orden->fkIdUserV->nombre." ".$orden->fkIdUserV->apellido);?></span></div>
                    <div class="row col-xs-12" style="font-size: 10px"><strong>Obs:</strong> <?= $orden->observacionesCaja;?></div>
                </div>

            </div>
        </div>
    </div>
    <div style="width:123px; position: relative; float: right;">
        <div class="row" style="font-size: 10.5px">
            <div class="col-xs-12 row text-center"><h3><strong><?= $orden->correlativo;?></strong></h3></div>
            <div class="col-xs-12 row text-center" style="font-size: 8px"><strong><?= $orden->fkIdSucursal->nombre;?></strong></div>
            <div class="col-xs-12 row text-center"><h4><strong><?= $orden->codigoServicio;?></strong></h4></div>
            <div class="col-xs-12 row"><span class="row"><strong><?= "CLIENTE:";?></strong> <span class="col-xs-12"><?= ((!empty($orden->fk_idCliente))?$orden->fkIdCliente->nombreNegocio:$orden->responsable);?></span></div>
            <div class="col-xs-12 row"><span class="row"><strong><?= "RESP:";?></strong> <span class="col-xs-12"><?= $orden->responsable;?></span></div>
            <div class="col-xs-12 row"><span class="row"><strong><?= "FECHA:";?></strong> <span class="col-xs-12"><?= date("d-m-Y / H:i",strtotime($orden->fechaCobro));?></span></span></div>
            <div class="col-xs-12 row" style="font-size: 10px"><strong>Diseñador/a:</strong> <?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></div>
            <div class="col-xs-12 row">
                <?php foreach ($orden->ordenDetalles as $producto){ ?>
                    <div class="col-xs-12" style="border: 1.5px solid;">
                        <?= $producto->fkIdProductoStock->fkIdProducto->formato;?> /
                        <?= $producto->cantidad; ?> /
                        <?= (($producto->C)?"C":"").(($producto->M)?"M":"").(($producto->Y)?"Y":"").(($producto->K)?"K":"");?>
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
