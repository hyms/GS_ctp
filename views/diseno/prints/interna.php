<div style="background-color: #ffffff; color: #000000;">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?= "Orden Interna";?></strong></h3>
                <h4 class="text-right"><strong><?= $orden->codigoServicio; ?></strong></h4>
            </div>

            <div class="row">
                <div class="col-xs-8"><strong><?= "Responsable:";?></strong> <?= $orden->responsable;?></div>
                <div class="text-right"><strong><?= "FECHA:";?></strong> <?= date("d-m-Y",strtotime($orden->fechaGenerada));?></div>
            </div>

            <div class="row well well-sm" style="height:200px; border-color: #000000">
                <table class="table table-condensed" >
                    <thead><tr>
                        <th><?= "Nº"; ?></th>
                        <th><?= "Formato"; ?></th>
                        <th><?= "Cant."; ?></th>
                        <th><?= "Colores"; ?></th>
                        <th><?= "Trabajo"; ?></th>
                        <th><?= "Pinza"; ?></th>
                        <th><?= "Resol."; ?></th>
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
                            <div class="text-center" style="font-size: 11px"><?= "firma";?></div>
                            <div><?= "Nombre: ".$orden->responsable?></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-xs-offset-1">
                    <div class="row">
                        <div class="col-xs-12"><strong>Recepcionado por: </strong> <?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><strong>Obs:</strong> <?= $orden->observaciones;?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
