<?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form',
        //'action'=>CHtml::normalizeUrl(array('/distribuidora/index')),
        'htmlOptions'=>array(
            'class'=>'form-horizontal',
            'role'=>'form'
        ),
    ));
?>
<div class="form-group col-xs-6" >
    <?php echo CHtml::label('Monto en Caja','monto',array('class'=>'control-label col-xs-6')); ?>
    <div class="col-xs-6">
        <?php echo CHtml::activeTextField($caja,'monto',array('class'=>'form-control ','readonly'=>true)); ?>
    </div>
    <?php echo CHtml::error($caja,'monto',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group col-xs-6" >
    <?php echo CHtml::label('Monto Entregado','monto',array('class'=>'control-label col-xs-6')); ?>
    <div class="col-xs-6">
        <?php echo CHtml::activeTextField($arqueo,'monto',array('class'=>'form-control','readonly'=>true)); ?>
    </div>
    <?php echo CHtml::error($arqueo,'monto',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group col-xs-6" >
    <?php echo CHtml::label('Saldo','saldo',array('class'=>'control-label col-xs-6')); ?>
    <div class="col-xs-6">
        <?php echo CHtml::activeTextField($arqueo,'saldo',array('class'=>'form-control','readonly'=>true)); ?>
    </div>
    <?php echo CHtml::error($arqueo,'saldo',array('class'=>'label label-danger')); ?>
</div>

<?php $this->endWidget(); ?>
