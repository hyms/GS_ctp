<?php $arqueo->fechaMovimientos=$fecha;?>
<div class="panel panel-default hidden-print">
    <div class="panel-heading">
        <span class="panel-title"><strong>Arqueo</strong></span>

    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'detalle-venta-detalleVenta-form',
            //'action'=>CHtml::normalizeUrl(array('/distribuidora/index')),
            'htmlOptions'=>array(
                'class'=>'form-horizontal',
                'role'=>'form'
            ),
        ));
        ?>
        <div class="form-group col-xs-5" >
            <?php echo CHtml::label('Monto en Caja','monto',array('class'=>'control-label col-xs-6')); ?>
            <div class="col-xs-5">
                <?php echo CHtml::activeTextField($caja,'monto',array('class'=>'form-control ','readonly'=>true)); ?>
            </div>
            <?php echo CHtml::error($caja,'monto',array('class'=>'label label-danger')); ?>

        </div>
        <?php
        if($dia!=date("d")) {
            ?>
            <div class="form-group col-xs-5">
                <?php echo CHtml::label('Monto a Entregar', 'monto', array('class' => 'control-label col-xs-6')); ?>
                <div class="col-xs-5">
                    <?php echo CHtml::activeTextField($arqueo, 'monto', array('class' => 'form-control')); ?>
                    <?php echo CHtml::activeHiddenField($arqueo, 'fechaMovimientos', array('class' => 'form-control')); ?>
                </div>
                <?php echo CHtml::error($arqueo, 'monto', array('class' => 'label label-danger')); ?>

            </div>
            <?php echo CHtml::submitButton('Continuar', array('class' => 'btn btn-default col-xs-offset-1')); ?>
        <?php
        }
        ?>
        <?php $this->endWidget(); ?>
    </div>
</div>