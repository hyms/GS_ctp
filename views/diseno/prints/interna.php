<?php
use kartik\helpers\Html;

?>
<div style="width:593px; position: relative; float: left;">
    <div class="col-xs-12">
        <div class="row">
            <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?= "Orden Interna";?></strong></h3>
            <h3 class="text-right"><strong><?= $orden->codigoServicio; ?></strong></h3>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <?= Html::tag('strong','Cliente:'); ?>
                <span class="text-capitalize"><?= $orden->responsable;?></span>
            </div>
            <div class="col-xs-6">
                <?= Html::tag('strong','Orden de Imprenta:'); ?>
                <?= $orden->codDependiente;?></div>
            <div class="text-right">
                <strong><?= "FECHA:";?></strong>
                <?= date("d-m-Y / H:i",strtotime($orden->fechaGenerada));?>
            </div>
        </div>

        <div class="row well well-sm" style="height:200px; border-color: #000000; background-color: #ffffff">
            <table class="table table-condensed">
                <thead><tr>
                    <?= Html::tag('th','Nº',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                    <?= Html::tag('th','Formato',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                    <?= Html::tag('th','Cant.',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                    <?= Html::tag('th','Colores',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                    <?= Html::tag('th','Trabajo',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                    <?= Html::tag('th','Pinza',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
                    <?= Html::tag('th','Resol.',['style'=>'border-bottom: solid; border-bottom-width: 1.5px;']);?>
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
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <!--   </div> -->
        </div>
        <div class="col-xs-12 row">
            <div class="row">
                <div class="col-xs-12"><strong>Gerenado por: </strong> <span class="text-capitalize"><?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido?></span></div>
            </div>
            <div class="row">
                <div class="col-xs-12"><strong>Obs:</strong> <?= $orden->observaciones;?></div>
            </div>
        </div>
    </div>
</div>
<div style="width:123px; position: relative; float: right;">
    <div class="row" style="font-size: 10.5px">
        <div class="col-xs-12 row text-center"><h3><strong><?= $orden->codigoServicio;?></strong></h3></div>
        <div class="col-xs-12 row text-center" style="font-size: 8px"><strong><?= $orden->fkIdSucursal->nombre;?></strong></div>
        <div class="col-xs-12 row"><span class="row"><strong><?= "CLIENTE:";?></strong> <span class="col-xs-12"><?= $orden->responsable;?></span></div>
        <div class="col-xs-12 row"><span class="row"><strong><?= "I.IMP:";?></strong> <span class="col-xs-12"><?= $orden->codDependiente;?></span></div>
        <div class="col-xs-12 row"><span class="row"><strong><?= "FECHA:";?></strong> <span class="col-xs-12"><?= date("d-m-Y / H:i",strtotime($orden->fechaGenerada));?></span></span></div>
        <div class="col-xs-12 row" style="font-size: 10px"><strong>Diseñador/a:</strong> <span class="text-capitalize"><?= $orden->fkIdUserD->nombre." ".$orden->fkIdUserD->apellido;?></span></div>
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