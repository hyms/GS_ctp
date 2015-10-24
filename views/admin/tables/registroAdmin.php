<?php
use kartik\helpers\Html;

$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w',strtotime($fecha))]." ".date('d',strtotime($fecha))." de ".$meses[date('n',strtotime($fecha))-1]. " del ".date('Y',strtotime($fecha));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <strong>REGISTRO DIARIO CAJA ADMINISTRACION</strong>
        </h3>
    </div>
    <div class="panel-body">
        <div class="text-right"><?= $fecha;?></div>
    </div>
    <?php $total=0;?>
    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <?= Html::tag('th','Comprobante'); ?>
            <?= Html::tag('th','Detalle'); ?>
            <?= Html::tag('th','Ingreso'); ?>
            <?= Html::tag('th','Egreso'); ?>
            <?= Html::tag('th','Saldo'); ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($arqueo as $item){?>
            <tr>
                <?php $total=$total+$item->monto;?>
                <?= Html::tag('td',$item->fkIdCajaOrigen->fkIdSucursal->nombre); ?>
                <?= Html::tag('td',$item->observaciones); ?>
                <?= Html::tag('td',$item->monto); ?>
                <?= Html::tag('td',''); ?>
                <?= Html::tag('td',$total); ?>
            </tr>
        <?php }?>
        <tr>
            <?php $total=$total+$recibos[1];?>
            <?= Html::tag('td',''); ?>
            <?= Html::tag('td','Recibos de Ingreso'); ?>
            <?= Html::tag('td',$recibos[1]); ?>
            <?= Html::tag('td',''); ?>
            <?= Html::tag('td',$total); ?>
        </tr>
        <tr>
            <?php $total=$total=$total-$recibos[0];?>
            <?= Html::tag('td',''); ?>
            <?= Html::tag('td','Recibos de Engreso'); ?>
            <?= Html::tag('td',''); ?>
            <?= Html::tag('td',$recibos[0]); ?>
            <?= Html::tag('td',$total); ?>
        </tr>

        <tr>
            <td colspan="4" class="text-right"><strong>Total Saldo</strong></td>
            <?= Html::tag('td',$total); ?>
        </tr>
        </tbody>
    </table>
</div>
