<div style="background-color: #ffffff; color: #000000; width:752px;height:306px;">
    <!-- <div class="row"> -->
    <div class="col-xs-12">
        <div class="row">
            <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?= "Orden de Reposicion";?></strong></h3>
            <h3 class="text-right"><strong><?= $orden->codigoServicio; ?></strong></h3>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Tipo de Falla: </strong><?php $data = \app\components\SGOperation::tiposReposicion($orden->tipoRepos); if(!is_array($data))echo $data; ?>
            </div>
            <div class="text-right">
                <strong>Fecha: </strong><?= date('d-m-Y / H:i',strtotime($orden->fechaGenerada)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Atribuible a: </strong><?= $orden->responsable ?>
            </div>
            <div class="col-xs-4">
                <strong>Correlativo de Orden: </strong><?php if(empty($orden->fk_idParent)) echo $orden->codDependiente;else echo $orden->fkIdParent->correlativo; ?>
            </div>
        </div>
        <div class="row well well-sm" style="height:200px; border-color: #000000; background-color: #ffffff">
            <table class="table table-condensed" style="background-color: #ffffff">
                <thead><tr>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Nº"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Formato"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Cant."; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Colores"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Trabajo"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Pinza"; ?></th>
                    <th style="border-bottom: solid; border-bottom-width: 1.5px;"><?= "Resol."; ?></th>
                </tr></thead>

                <tbody style="font-size:12px; ">
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
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <!--   </div> -->
        </div>
        <div class="col-xs-12 row">
            <div class="row">
                <div class="col-xs-12"><strong><?= "Realizado por:";?></strong> <?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></div>
                <div class="col-xs-12"><strong>Obs:</strong> <?= $orden->observaciones;?></div>
            </div>
        </div>
    </div>
    <!-- </div> -->
</div>
