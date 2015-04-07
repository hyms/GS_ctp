<div style="background-color: #ffffff; color: #000000;">
    <div class="row">
        <div style="width:723px;">
            <div class="col-xs-12">
                <div class="row">
                    <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?php echo "Orden Interna";?></strong></h3>
                    <h4 class="text-right"><strong><?php echo $orden->codigo; ?></strong></h4>
                    <div class="col-xs-offset-3 col-xs-5 text-center"><strong><?php echo (!empty($orden->tipoRI))?ServicioVentaRI::getTipo($orden->tipoRI):"";?></strong></div>
                    <div class="col-xs-3 text-right"><strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($orden->fechaRegistro));?></div>

                </div>

                <div class="row">
                    <div class="col-xs-7"><strong><?php echo "Responsable:";?></strong> <?php echo $orden->responsable;?></div>
                </div>

                <div class="row well well-sm" style="height:200px; border-color: #000000">
                    <table class="table table-condensed" >
                        <thead><tr>
                            <th><?php echo "Nº"; ?></th>
                            <th><?php echo "Formato"; ?></th>
                            <th><?php echo "Nº Placas"; ?></th>
                            <th><?php echo "Colores"; ?></th>
                            <th><?php echo "Trabajo"; ?></th>
                            <th><?php echo "Pinza"; ?></th>
                            <th><?php echo "Resol."; ?></th>
                        </tr></thead>

                        <tbody>
                        <?php $i=0; foreach ($orden->detalleVentaRIs as $producto){ $i++;?>
                            <tr>
                                <td class="col-xs-1">
                                    <?php echo $i;?>
                                </td>
                                <td class="col-xs-2">
                                    <?php echo $producto->fkIdProductoStock->fkIdProducto->color;?>
                                </td>
                                <td class="col-xs-2">
                                    <?php echo $producto->cantidad; ?>
                                </td>
                                <td class="col-xs-2">
                                    <?php echo (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                                </td>
                                <td class="col-xs-2">
                                    <?php echo $producto->trabajo;?>
                                </td>
                                <td class="col-xs-1">
                                    <?php echo $producto->pinza;?>
                                </td>
                                <td class="col-xs-1">
                                    <?php echo $producto->resolucion;?>
                                </td>
                                <td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <!--   </div> -->
                </div>
                <div class="col-xs-12 row">
                    <div class="col-xs-5">
                        <div class="row">
                            <div class="col-xs-11 well well-sm" style="border-color: #000000;">
                                <br><br><br>
                                <div class="text-center" style="font-size: 11px"><?php echo "firma";?></div>
                                <div><?php echo "Nombre: ".$orden->responsable?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-5 col-xs-offset-1">
                        <div class="row">
                            <div class="col-xs-12"><strong>Recepcionado por: </strong> <?php echo $orden->fkIdUser->nombre." ".$orden->fkIdUser->apellido;?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12"><strong>Obs:</strong> <?php echo $orden->obseraciones;?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
