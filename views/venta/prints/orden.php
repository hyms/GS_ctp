<?php
    use kartik\helpers\Html;

?>
<div class="row" style="color: #000000">
    <div style="width:593px; position: relative; float: left;">
        <div class="col-xs-12">
            <div class="row">
                <h3 class="col-xs-offset-2 col-xs-7 text-center"><?= Html::tag('strong','Orden de Trabajo');?></h3>
                <h4 class="text-right"><?= Html::tag('strong',(($orden->cfSF==0)?$orden->codigoServicio:" "))?></h4>
                <div class="row col-xs-12">
                    <div class="col-xs-offset-4 col-xs-3 text-center"><?= Html::tag('small',$orden->fkIdSucursal->nombre);?></div>
                    <div class="text-right"><?= Html::tag('strong','Fecha:').' '. (((empty($orden->fechaCobro))?date("d-m-Y / H:i"):date("d-m-Y / H:i",strtotime($orden->fechaCobro))));?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-5"><?= Html::tag('strong','Cliente:').' '.Html::tag('span',((!empty($orden->fk_idCliente))?$orden->fkIdCliente->nombreNegocio:$orden->responsable)." - ".$orden->telefono,['class'=>'text-capitalize']);?></div>
                <div class="col-xs-5"><?= Html::tag('strong','NitCi:').' '.((!empty($orden->fk_idCliente))?$orden->fkIdCliente->nitCi:""); ?></div>
            </div>

            <div class="row well well-sm" style="height:170px; border-color: #000; background-color: #fff; color: #000">
                <table class="table table-condensed">
                    <thead><tr>
                        <?= Html::tag('th','Nº',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                        <?= Html::tag('th','Formato',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                        <?= Html::tag('th','Cant.',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                        <?= Html::tag('th','Colores',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                        <?= Html::tag('th','Trabajo',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                        <?= Html::tag('th','Pinza',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                        <?= Html::tag('th','Resol.',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                        <?= Html::tag('th','Costo',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                        <?= Html::tag('th','Adicional',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                        <?= Html::tag('th','Total',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                    </tr></thead>

                    <tbody>
                    <?php $i=0; foreach ($orden->ordenDetalles as $producto){ $i++;?>
                        <tr>
                            <?= Html::tag('td',$i,['style'=>'font-size:12px; padding-top: 4px;']);?>
                            <?= Html::tag('td',$producto->fkIdProductoStock->fkIdProducto->formato,['style'=>'font-size:12px; padding-top: 4px;']);?>
                            <?= Html::tag('td',$producto->cantidad,['style'=>'font-size:12px; padding-top: 4px;']);?>
                            <?= Html::tag('td',(($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":""),['style'=>'font-size:12px; padding-top: 4px;']);?>
                            <?= Html::tag('td',$producto->trabajo,['style'=>'font-size:12px; padding-top: 4px;']);?>
                            <?= Html::tag('td',$producto->pinza,['style'=>'font-size:12px; padding-top: 4px;']);?>
                            <?= Html::tag('td',$producto->resolucion,['style'=>'font-size:12px; padding-top: 4px;']);?>
                            <?= Html::tag('td',$producto->costo,['style'=>'font-size:12px; padding-top: 4px;']);?>
                            <?= Html::tag('td',$producto->adicional,['style'=>'font-size:12px; padding-top: 4px;']);?>
                            <?= Html::tag('td',$producto->total,['style'=>'font-size:12px; padding-top: 4px;']);?>
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
                            <div class="text-center" style="font-size: 11px"><?= "Firma";?></div>
                            <div class="row col-xs-12"><?= Html::tag('span','Nombre: '.$orden->responsable,['class'=>'text-capitalize']);?> <?= Html::tag('strong',$orden->correlativo);?></div>
                            <div class="text-center" style="font-size: 10px"><?= Html::tag('smal','Autorizo la elaboración de la presente orden');?></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-xs-offset-1">
                    <div class="row col-xs-12" style="border: 1.5px solid; border-formato: #000000;"><?= Html::tag('strong','Total:')?>
                        <?php
                            if(is_numeric($orden->montoVenta)) {
                                echo $orden->montoVenta . ' Bs ' . Html::tag('span', $monto, ['style' => 'font-size:11px']);
                            } ?>
                    </div>
                    <?php if($orden->montoDescuento>0) {
                        echo Html::tag('div',
                                       Html::tag('strong', 'Desc:') . ' ' . $orden->montoDescuento . ' Bs',
                                       ['style' => 'font-size: 10px', 'class' => 'row col-xs-5']);
                    }?>
                    <?php if($orden->tipoPago){?>
                        <div class="row col-xs-5" style="font-size: 12px"><?= Html::tag('strong', 'A/C:').' '. $orden->fkIdMovimientoCaja->monto.' Bs';?></div>
                        <div class="row col-xs-5" style="font-size: 12px"><?= Html::tag('strong', 'Saldo:').' '. ((($orden->montoVenta-$orden->fkIdMovimientoCaja->monto)>0)?($orden->montoVenta-$orden->fkIdMovimientoCaja->monto):"0").' Bs';?></div>
                        <div class="row col-xs-5" style="font-size: 10px"><?= Html::tag('strong', 'Venta a Credito');?></div>
                        <div class="row col-xs-5" style="font-size: 10px"><?= Html::tag('strong', 'Plazo:').' '. date("d-m-Y",strtotime($orden->fechaPlazo));?></div>
                    <?php } ?>
                    <div class="row col-xs-12" style="font-size: 10px"><?= Html::tag('strong', 'Diseñador/a:');?> <span class="text-capitalize"><?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></span></div>
                    <div class="row col-xs-12" style="font-size: 10px"><?= Html::tag('strong', 'Obs:');?> <?= $orden->observaciones;?></div>
                    <div class="row col-xs-12" style="font-size: 10px"><?= Html::tag('strong', 'Cajer@:');?> <span class="text-capitalize"><?= ((empty($orden->fkIdUserV))?Yii::$app->user->identity->nombre." ".Yii::$app->user->identity->apellido:$orden->fkIdUserV->nombre." ".$orden->fkIdUserV->apellido);?></span></div>
                    <div class="row col-xs-12" style="font-size: 10px"><?= Html::tag('strong', 'Obs:').' '. $orden->observacionesCaja;?></div>
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
            <div class="col-xs-12 row" style="font-size: 10px"><?= Html::tag('strong','Diseñador/a:').' '. $orden->fkIdUserD->nombre.' '.$orden->fkIdUserD->apellido;?></div>
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
