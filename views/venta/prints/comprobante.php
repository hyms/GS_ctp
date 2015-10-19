<?php
    use kartik\helpers\Html;

?>

<div class="form-group" style="width:793px; height:529px;">
<?= Html::tag('h3','COMPROBANTE DE ENTREGA '.$arqueo->correlativoCierre,['class'=>'text-right']); ?>
    <div class="text-right"><?= Html::tag('strong',date("d/m/Y - H:i",strtotime($arqueo->time)));?></div>
    <div class="col-xs-12"><?= Html::tag('strong','Recibo de:').' '.Html::tag('span',$arqueo->fkIdUser->nombre." ".$arqueo->fkIdUser->apellido,['class'=>'text-capitalize']); ?></div>
    <div class="col-xs-4"><?= Html::tag('strong','La suma de:').' '.$arqueo->monto;?> Bs.</div>
    <div class="col-xs-4"><?= Html::tag('strong','Saldo de:').' '.$arqueo->saldoCierre;?></div>
    <div class="col-xs-12"><?= Html::tag('strong','Por concepto:').' '.$arqueo->observaciones;?></div>

    <div class="col-xs-12">
        <div class="col-xs-offset-1 col-xs-4 well" style="border-color: #000000; background-color: #FFFFFF">
            <br><br><br>
            <div class="text-center"><?= Html::tag('small','Firma'); ?></div>
            <div class="text-justify"><?= Html::tag('strong','Nombre y Ap:');?></div>
            <div class="text-justify"><?= Html::tag('strong','CI:');?></div>
            <div class="text-center"><?= Html::tag('small','Entregue Conforme'); ?></div>
        </div>
        <div class="col-xs-offset-1 col-xs-4 well" style="border-color: #000000; background-color: #FFFFFF">
            <br><br><br>
            <div class="text-center"><?= Html::tag('small','Firma'); ?></div>
            <div class="text-justify"><?= Html::tag('strong','Nombre y Ap:');?></div>
            <div class="text-justify"><?= Html::tag('strong','CI:');?></div>
            <div class="text-center"><?= Html::tag('small','Recibi Conforme'); ?></div>
        </div>
    </div>

</div>