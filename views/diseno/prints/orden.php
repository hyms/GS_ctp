<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="row col-xs-12">
                <div class="col-xs-3"><strong><?= $orden->fkIdSucursal->nombre;?></strong></div>
                <div class="text-right"><strong><?= "FECHA RECEPCION:";?></strong> <?= $orden->fechaGenerada;?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-7"><strong><?= "Responsable:";?></strong> <?= $orden->responsable;?></div>
            <div class="col-xs-3"><strong><?= "Telefono:";?></strong> <?= $orden->telefono;?></div>
        </div>

            <table class="table table-bordered table-hover table-condensed">
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

        <div class="row">
            <div><strong>Diseñador/a:</strong> <?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></div>
            <div><strong>Obs:</strong> <?= $orden->observaciones;?></div>
        </div>
    </div>
</div>
