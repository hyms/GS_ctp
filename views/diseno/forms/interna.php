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
            ]);
            ?>
        </div>
    </div>

    <div class="col-xs-8">
        <div class="well well-sm">
            <div class = "row">
                <h4 class="col-xs-4"><strong>Orden Internas</strong></h4>
                <h4 class="col-xs-4 text-center"><strong><?php echo "#"//$orden->codigo;?></strong></h4>
                <h4 class="col-xs-4 text-right"><strong><?php echo date("d/m/Y");//date("d/m/Y",strtotime($venta->fechaRegistro));?></strong></h4>
            </div>

            <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
            <div class="row">
                <div class="col-xs-6">
                    <?= $form->field($orden, 'responsable',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($orden, 'tipoRI',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50]) ?>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong class="panel-title">Detalle de Orden</strong>
                </div>
                    <?= $this->render('detalleOrden',array('detalle'=>$detalle,'orden'=>$orden));?>
            </div>

            <div class="form-group">
                <div class="text-center">
                    <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
                    <?= Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>