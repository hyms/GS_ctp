<?php
use kartik\helpers\Html;

?>
<div style="width:793px; height:529px;">
    <div class="col-xs-12">
        <div class="row">
            <h3 class="col-xs-offset-2 col-xs-7 text-center"><?=Html::tag('strong','Pago de Deuda ('.$orden->correlativo.')') ;?></h3>
            <div class="text-right"><?= Html::tag('strong','Fecha:').' '.date("d-m-Y",strtotime($deuda->time));?></div>
        </div>

        <div class="row">
            <div class="col-xs-5"><?= Html::tag('strong','Cliente:').' '.Html::tag('span',((!empty($orden->fk_idCliente))?$orden->fkIdCliente->nombreNegocio:""),['class'=>'text-capitalize']);?></div>
            <div class="col-xs-5"><?= Html::tag('strong','NitCi:').' '.((!empty($orden->fk_idCliente))?$orden->fkIdCliente->nitCi:""); ?></div>
        </div>
        <div class="row">
            <div class="col-xs-5"><?= Html::tag('strong','Responsable:').' '.Html::tag('span',$orden->responsable,['class'=>'text-capitalize']);?></div>
            <div class="col-xs-5"><?= Html::tag('strong','Telefono:').' '.$orden->telefono; ?></div>
        </div>

        <div class="row well well-sm" style="height:180px; border-color: #000000; background-color: #fff; color: #000">
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
        </div>
        <div class="row">
            <?= Html::tag('strong','Total:').' '. $orden->montoVenta.' Bs '. $num ?>
        </div>
        <div class="row">
            <div class="col-xs-5">
                <div class="row">
                    <div class="col-xs-11 well well-sm" style="border-color: #000000; background-color: #FFFFFF">
                        <h5><?= Html::tag('strong','Deuda'); ?></h5>
                        <div class="row col-xs-5"><?= Html::tag('strong','Cancel.:').' '.$oldDeuda.' Bs';?></div>
                        <div class="row col-xs-5"><?= Html::tag('strong','Saldo:').' '.($orden->montoVenta - $oldDeuda).' Bs';?></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 col-xs-offset-1">
                <div class="row">
                    <div class="col-xs-11 well well-sm" style="border-color: #000000; background-color: #FFFFFF">
                        <h5><?= Html::tag('strong','Cancelado'); ?></h5>
                        <div class="row col-xs-5"><?= Html::tag('strong','A/C').' '.$deuda->monto.' Bs';?></div>
                        <div class="row col-xs-5"><?= Html::tag('strong','Saldo:').' '.($orden->montoVenta - ($oldDeuda+$deuda->monto)).' Bs';?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>