<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

?>
<div class="row">
    <div class="col-xs-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong class="panel-title">Productos</strong>
            </div>
            <?= $this->render('../tables/producto',[
                'producto'=>$producto,
                'tipo'=>$orden->tipoOrden,
            ]);
            ?>
        </div>
    </div>

    <div class="col-xs-8">
        <div class="well well-sm">
            <div class = "row">
                <h4 class="col-xs-4"><strong>Orden <?= ($orden->tipoOrden==0)?"de Trabajo":"Interna" ?></strong></h4>
                <h4 class="col-xs-4 text-center"><strong><?php echo $orden->correlativo;?></strong></h4>
                <h4 class="col-xs-4 text-right"><strong><?php echo date("d/m/Y",strtotime($orden->fechaGenerada));?></strong></h4>
            </div>

            <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
            <div class="row">
                <div class="col-xs-6">
                    <?= $form->field($orden, 'responsable',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50]) ?>
                </div>
                <?php if($orden->tipoOrden==0){?>
                <div class="col-xs-6">
                    <?= $form->field($orden, 'telefono',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50]) ?>
                </div>
                <?php } ?>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong class="panel-title">Datos de Orden</strong>
                </div>
                <div style="overflow: auto">
                <?= $this->render('detalleOrden',['detalle'=>$detalle,'orden'=>$orden]);?>
                </div>
            </div>
            <?= $form->field($orden, 'observaciones')->textArea(); ?>
            <div class="form-group">
                <div class="text-center">
                    <?php //echo CHtml::link('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
                    <?= Html::submitButton($orden->isNewRecord ? 'Guardar' : 'Modificar', ['class' => $orden->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
