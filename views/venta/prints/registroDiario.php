<?php
    use kartik\helpers\Html;

    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $fecha = $dias[date('w',strtotime($fecha))]." ".date('d',strtotime($fecha))." de ".$meses[date('n',strtotime($fecha))-1]. " del ".date('Y',strtotime($fecha))." / ".date('H:i',strtotime($fecha));
?>
<div>
    <h3 class="text-center"><strong><?= "REGISTRO DIARIO"?></strong></h3>
    <div class="text-right"><?= ((!empty($arqueo->fkIdUser->fk_idSucursal))?$arqueo->fkIdUser->fkIdSucursal->nombre:"").", ".$fecha;?></div>
    <?php $total=0;?>
    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <?= Html::tag('th','Comprobante',['style'=>'border: 1px solid black; text-align: center;']);?>
            <?= Html::tag('th','Detalle',['style'=>'border: 1px solid black; text-align: center;']);?>
            <?= Html::tag('th','Ingreso',['style'=>'border: 1px solid black; text-align: center;']);?>
            <?= Html::tag('th','Egreso',['style'=>'border: 1px solid black; text-align: center;']);?>
            <?= Html::tag('th','Saldo',['style'=>'border: 1px solid black; text-align: center;']);?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php $total=$saldo;?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td','Saldo',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',$saldo,['style'=>'border: 1px solid black; text-align: right;']);?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',$total,['style'=>'border: 1px solid black; text-align: right;']);?>
        </tr>
        <tr>
            <?php $total=$total+$ventas+$deudas;?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td','Total de Ingresos',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',($ventas+$deudas),['style'=>'border: 1px solid black; text-align: right;']);?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',$total,['style'=>'border: 1px solid black; text-align: right;']);?>
        </tr>
        <tr>
            <?php $total=$total+$recibos[1];?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td','Recibos de Ingreso',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',$recibos[1],['style'=>'border: 1px solid black; text-align: right;']);?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',$total,['style'=>'border: 1px solid black; text-align: right;']);?>
        </tr>
        <tr>
            <?php $total=$total-$recibos[0];?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td','Recibos de Egreso',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',$recibos[0],['style'=>'border: 1px solid black; text-align: right;']);?>
            <?= Html::tag('td',$total,['style'=>'border: 1px solid black; text-align: right;']);?>
        </tr>
        <tr>
            <?php $total=$total-$cajas;?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td','Caja Chica Gastos',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',$cajas,['style'=>'border: 1px solid black; text-align: right;']);?>
            <?= Html::tag('td',$total,['style'=>'border: 1px solid black; text-align: right;']);?>
        </tr>
        <tr>
            <?php $total=$total-$arqueo->monto;?>
            <?= Html::tag('td',$arqueo->correlativoCierre,['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',$arqueo->observaciones,['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td','',['style'=>'border: 1px solid black;']);?>
            <?= Html::tag('td',$arqueo->monto,['style'=>'border: 1px solid black; text-align: right;']);?>
            <?= Html::tag('td',round($total, 1),['style'=>'border: 1px solid black; text-align: right;']);?>
        </tr>
        <tr>
            <?= Html::tag('td',Html::tag('strong','Total Saldo'),['style'=>'text-align: right;','colspan'=>'4']);?>
            <?= Html::tag('td',round($total, 1),['style'=>'border: 1px solid black; text-align: right;']);?>
        </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-xs-offset-1 col-xs-4 well" style="border-color: #000000; background-color: #FFFFFF">
            <br><br>
            <?= Html::tag('p','Firma',['class'=>'text-center']);?>
            <?= Html::tag('span','Nombre:');?>
            <?= Html::tag('p','Entregue Conforme',['class'=>'text-center']);?>
        </div>
        <div class="col-xs-offset-1 col-xs-4 well" style="border-color: #000000; background-color: #FFFFFF">
            <br><br>
            <?= Html::tag('p','Firma',['class'=>'text-center']);?>
            <?= Html::tag('span','Nombre:');?>
            <?= Html::tag('p','Recibi Conforme',['class'=>'text-center']);?>
        </div>
    </div>
</div>