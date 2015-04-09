<div style="background-color: #ffffff; color: #000000;">
    <div class="row">
        <div style="width:593px; position: relative; float: left;">
            <div class="col-xs-12">
                <div class="row">
                    <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?php echo "Orden de Trabajo";?></strong></h3>
                    <h4 class="text-right"><strong><?php echo ($venta->tipoVenta==0)?$venta->codigoServicio:" "; ?></strong></h4>
                    <div class="row col-xs-12">
                        <div class="col-xs-offset-4 col-xs-3 text-center"><small><?php echo $venta->fkIdSucursal->nombre;?></small></div>
                        <div class="text-right"><strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($venta->fechaVenta));?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-7"><strong><?php echo "CLIENTE:";?></strong> <?php echo $venta->fkIdCliente->nombreNegocio."(".$venta->responsable.")";?></div>
                    <div class="col-xs-3"><strong><?php echo "NIT:";?></strong> <?php echo $venta->fkIdCliente->nitCi;?></div>
                </div>

                <div class="row well well-sm" style="height:170px; font-size: 11px; border-color: #000000">
                    <table class="table table-hover table-condensed">
                        <thead><tr>
                            <th><?php echo "Nº"; ?></th>
                            <th><?php echo "Formato"; ?></th>
                            <th><?php echo "Nº.Placas"; ?></th>
                            <th><?php echo "Colores"; ?></th>
                            <th><?php echo "Trabajo"; ?></th>
                            <th><?php echo "Pinza"; ?></th>
                            <th><?php echo "Resol."; ?></th>
                            <th><?php echo "Costo"; ?></th>
                            <th><?php echo "Adicional"; ?></th>
                            <th><?php echo "Total"; ?></th>
                        </tr></thead>

                        <tbody>
                        <?php $i=0; foreach ($venta->detalleServicios as $producto){ $i++;?>
                            <tr>
                                <td>
                                    <?php echo $i;?>
                                </td>
                                <td>
                                    <?php echo $producto->fkIdProductoStock->fkIdProducto->color;?>
                                </td>
                                <td class="col-xs-1">
                                    <?php echo $producto->cantidad; ?>
                                </td>
                                <td>
                                    <?php echo (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                                </td>
                                <td>
                                    <?php echo $producto->trabajo;?>
                                </td>
                                <td>
                                    <?php echo $producto->pinza;?>
                                </td>
                                <td>
                                    <?php echo $producto->resolucion;?>
                                </td>
                                <td>
                                    <?php echo $producto->costo;?>
                                </td>
                                <td>
                                    <?php echo $producto->adicional;?>
                                </td>
                                <td>
                                    <?php echo $producto->total;?>
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
                            <div class="col-xs-11 well well-sm" style="border-color: #000000;">
                                <br><br><br>
                                <div class="text-center" style="font-size: 11px"><?php echo "firma";?></div>
                                <div><?php echo "Nombre: ".$venta->responsable?></div>
                                <div class="text-center" style="font-size: 10px"><small><?php echo "Autorizo la elaboración de la presente orden";?></small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-xs-offset-1">
                            <div class="row col-xs-12" style="border: 1.5px solid; border-color: #000000;"><strong>Total:</strong> <?php echo $venta->montoVenta." Bs. <span style=\"font-size:11px\">("; $this->widget('ext.numerosALetras', array('valor'=>$venta->montoVenta,'despues'=>'')); echo ")</span>";?></div>
                            <?php if($venta->montoDescuento>0){?>
                                <div class="row col-xs-5" style="font-size: 10px"><strong>Aut. por:</strong> <?php echo ($venta->tipoPago==1)?CHtml::encode(($venta->autorizado==0)?'Erick Paredes':'Miriam Martinez'):""?></div>
                                <div class="row col-xs-5" style="font-size: 10px"><strong>Desc:</strong> <?php echo $venta->montoDescuento." Bs.";?></div>
                            <?php }?>
                            <?php if($venta->tipoPago){?>
                                <div class="row col-xs-5" style="font-size: 12px"><strong>A/C:</strong> <?php echo $venta->montoPagado." Bs.";?></div>
                                <div class="row col-xs-5" style="font-size: 12px"><strong>Saldo:</strong> <?php echo ((($venta->montoVenta-$venta->montoPagado)>0)?($venta->montoVenta-$venta->montoPagado):"0")." Bs.";?></div>
                                <div class="row col-xs-5" style="font-size: 10px"><strong>Venta a Credito</strong></div>
                                <div class="row col-xs-5" style="font-size: 10px"><strong>Plazo:</strong> <?php echo date("d-m-Y",strtotime($venta->fechaPlazo));?></div>
                            <?php } ?>
                            <div class="row col-xs-12" style="font-size: 10px"><strong>Diseñador/a:</strong> <?php echo $venta->fkIdUserD->nombre." ".$venta->fkIdUserD->apellido;?></div>
                            <div class="row col-xs-12" style="font-size: 10px"><strong>Obs:</strong> <?php echo $venta->obseraciones;?></div>
                            <div class="row col-xs-12" style="font-size: 10px"><strong>Cajer@:</strong> <?php echo $venta->fkIdUserV->nombre." ".$venta->fkIdUserV->apellido;?></div>
                            <div class="row col-xs-12" style="font-size: 10px"><strong>Obs:</strong> <?php echo $venta->obseracionesCaja;?></div>
                    </div>

                </div>
            </div>
        </div>
        <div style="width:123px; position: relative; float: right;">
            <div class="row" style="font-size: 11px">
                <div class="col-xs-12 row text-center"><h4><strong><?php echo $venta->correlativo;?></strong></h4></div>
                <div class="col-xs-12 row text-center" style="font-size: 8px"><?php echo $venta->fkIdSucursal->nombre;?></div>
                <div class="col-xs-12 row text-center"><h4><strong><?php echo $venta->codigoServicio;?></strong></h4></div>
                <div class="col-xs-12 row"><span class="row"><strong><?php echo "CLIENTE:";?></strong> <span class="col-xs-12"><?php echo $venta->fkIdCliente->nombreNegocio;?></span></div>
                <div class="col-xs-12 row"><span class="row"><strong><?php echo "RESP:";?></strong> <span class="col-xs-12"><?php echo $venta->responsable;?></span></div>
                <div class="col-xs-12 row"><span class="row"><strong><?php echo "FECHA:";?></strong> <span class="col-xs-12"><?php echo date("d-m-Y",strtotime($venta->fechaVenta));?></span></span></div>
                <div class="col-xs-12 row" style="font-size: 10px"><strong>Diseñador/a:</strong> <?php echo $venta->fkIdUserD->nombre." ".$venta->fkIdUserD->apellido;?></div>
                <div class="col-xs-12 row">
                    <?php foreach ($venta->detalleServicios as $producto){ ?>
                        <div class="col-xs-12" style="border: 1.5px solid;">
                            <?php echo $producto->fkIdProductoStock->fkIdProducto->color;?> /
                            <?php echo $producto->cantidad; ?> /
                            <?php echo (($producto->C)?"C ":"").(($producto->M)?"M ":"").(($producto->Y)?"Y ":"").(($producto->K)?"K ":"");?>
                            <br>
                            <?php echo $producto->trabajo;?> /
                            <?php echo $producto->pinza;?> /
                            <?php echo $producto->resolucion;?>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>