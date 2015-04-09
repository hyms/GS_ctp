<div class="panel-group" id="accordion">
    <?php foreach ($placas as $key => $placa){?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key?>">
                        <strong><?php echo $placa->idProducto0->color; ?></strong> <small><?php echo $placa->idProducto0->detalle; ?></small>
                    </a>
                </div>
            </div>
            <div id="collapse<?php echo $key?>" class="panel-collapse collapse in">
                <div class="panel-body">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <td></td>
                            <?php foreach ($clienteTipos as $clienteTipo){?>
                                <td class="text-center">
                                    <strong><?php echo $clienteTipo->nombre; ?></strong>
                                </td>
                            <?php }?>
                        </tr>
                        <?php foreach ($cantidades as $cantidad){?>
                            <tr>
                                <td class="text-left col-xs-2"><h4><strong><?php echo CHtml::link($cantidad->Inicio." - ".$cantidad->final,array('ctp/cantidad','id'=>$cantidad->idCantidadCTP), array('class' => 'openDlg divDialog','style'=>'color:#000'));?></strong></h4></td>
                                <?php foreach ($clienteTipos as $clienteTipo){?>
                                    <td>
                                        <div class="col-xs-6">
                                            <strong><?php echo "Precio SF"; ?></strong>
                                        </div>
                                        <div class="col-xs-6">
                                            <strong><?php echo "Precio CF"; ?></strong>
                                        </div>
                                    </td>
                                <?php }?>
                            </tr>
                            <?php foreach ($horarios as $horario){?>
                                <tr>
                                    <td class="text-right"><strong><?php echo CHtml::link(date("H:i",strtotime($horario->inicio))." - ".date("H:i",strtotime($horario->final)),array('ctp/horario','id'=>$horario->idHorario), array('class' => 'openDlg divDialog')); ?></strong></td>
                                    <?php foreach ($clienteTipos as $clienteTipo){?>
                                        <td>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <?php echo $model[$placa->idAlmacenProducto][$clienteTipo->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario]->precioSF; ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <?php echo $model[$placa->idAlmacenProducto][$clienteTipo->idTiposClientes][$cantidad->idCantidadCTP][$horario->idHorario]->precioCF; ?>
                                                </div>
                                            </div>

                                        </td>
                                    <?php }?>
                                </tr>
                            <?php }?>
                        <?php }?>
                    </table>
                </div>
            </div>
        </div>

    <?php }?>
</div>