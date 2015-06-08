<div>
    <div class="col-xs-12">
        <div class="row">
            <div class="row col-xs-12">
                <h4 class="col-xs-5"><?= $orden->fkIdSucursal->nombre." - ".$orden->correlativo;?></h4>
                <div class="text-right"><strong><?= "FECHA:";?></strong> <?= date("d-m-Y / H:i",strtotime($orden->fechaCobro));?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-7"><strong><?= "CLIENTE:";?></strong> <?= $orden->fkIdCliente->nombreNegocio."(".$orden->responsable.")";?></div>
            <div class="col-xs-3"><strong><?= "NIT:";?></strong> <?= $orden->fkIdCliente->nitCi;?></div>
        </div>

        <div class="row well well-sm" style="height:170px; border-color: #000; background-color: #fff">
            <table class="table table-hover table-condensed">
                <thead><tr>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Nº"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Formato"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Cant."; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Colores"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Trabajo"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Pinza"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Resol."; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Adicional"; ?></th>
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
                        <td class="col-xs-1" style="font-size:12px; padding-top: 4px;">
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
                            <?= $producto->adicional;?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <!--   </div> -->
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="row col-xs-12" style="font-size: 11px"><strong>Diseñador/a:</strong> <?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></div>
                <div class="row col-xs-12" style="font-size: 11px"><strong>Obs:</strong> <?= $orden->observaciones;?></div>
                <div class="row col-xs-12" style="font-size: 11px"><strong>Cajer@:</strong> <?= $orden->fkIdUserV->nombre." ".$orden->fkIdUserV->apellido;?></div>
                <div class="row col-xs-12" style="font-size: 11px"><strong>Obs:</strong> <?= $orden->observacionesCaja;?></div>
            </div>
            <div class="text-right">
                <div style="font-size: 11px"><strong>Impreso por:</strong> <?= Yii::$app->user->identity->nombre." ".Yii::$app->user->identity->apellido ?></div>
            </div>
        </div>
    </div>
</div>
