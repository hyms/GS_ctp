<h2>Producto <?php echo $almacen->idProducto0->codigo; ?><br><small><?php echo $almacen->idProducto0->material." - ".$almacen->idProducto0->detalle." - ".$almacen->idProducto0->color;?></small></h2>
<div class = "col-xs-4">
    <h3>En deposito</h3>
    <div class="row form-group">
        <?php echo CHtml::activeLabelEx($model,'cantidadU',array('class'=>'col-xs-6 control-label')); ?>
        <span class="col-xs-4"><?php echo $deposito->stockU ?></span>
    </div>
    <div class="row form-group">
        <?php echo CHtml::activeLabelEx($model,'cantidadP',array('class'=>'col-xs-6 control-label')); ?>
        <span class="col-xs-4"><?php echo $deposito->stockP ?></span>
    </div>
</div>
<div class = "col-xs-4">
    <h3>En existencia</h3>
    <div class="row form-group">
        <?php echo CHtml::activeLabelEx($model,'cantidadU',array('class'=>'col-xs-6 control-label')); ?>
        <span class="col-xs-4"><?php echo $almacen->stockU ?></span>
    </div>
    <div class="row form-group">
        <?php echo CHtml::activeLabelEx($model,'cantidadP',array('class'=>'col-xs-6 control-label')); ?>
        <span class="col-xs-4"><?php echo $almacen->stockP ?></span>
    </div>
</div>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'movimiento-almacen-add_reduce-form',
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'role'=>'form'
    ),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // See class documentation of CActiveForm for details on this,
    // you need to use the performAjaxValidation()-method described there.
    'enableAjaxValidation'=>false,
)); ?>
<div class="form col-xs-4">
    <h3>Añadir a stock</h3>
    <div class="form-group">
        <?php echo $form->labelEx($model,'cantidadU',array('class'=>'col-xs-6 control-label')); ?>
        <div class="col-xs-4">
            <?php echo $form->textField($model,'cantidadU',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'cantidadU',array('class'=>'label label-danger')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'cantidadP',array('class'=>'col-xs-6 control-label')); ?>
        <div class="col-xs-4">
            <?php echo $form->textField($model,'cantidadP',array('class'=>'form-control')); ?>
        </div>
        <?php echo $form->error($model,'cantidadP',array('class'=>'label label-danger')); ?>
    </div>
</div>
<div class="form-group col-xs-8">
    <?php echo $form->labelEx($model,'obs',array('class'=>'col-xs-3 control-label')); ?>
    <div class="col-xs-9">
        <?php echo $form->textArea($model,'obs',array('class'=>'form-control')); ?>
    </div>
    <?php echo $form->error($model,'obs',array('class'=>'label label-danger')); ?>
</div>

<div class="form-group col-xs-4">
    <?php // echo CHtml::link("Atras",array("stock/distribuidora"),array("class"=>"btn btn-default")); ?>
    <?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-default')); ?>
</div>

<?php $this->endWidget(); ?>

<!-- form -->
