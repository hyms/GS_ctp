<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

?>
    <div class="caja-form">

        <div class="panel panel-default">
            <div class="panel-body" >
                <?php
                    echo $this->render('../tables/producto',[
                        'producto'=>$producto,
                    ]);
                ?>
            </div>
        </div>

        <div class="well well-sm">
            <div class = "row">
                <h3 class="col-xs-4">Orden de Trabajo</h3>
                <h3 class="col-xs-4 text-center"><?php echo "#"//$venta->correlativo;?></h3>
                <h3 class="col-xs-4 text-right"><?php echo date("d/m/Y");//date("d/m/Y",strtotime($venta->fechaGenerada));?></h3>
            </div>

            <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
            <div class="row">
                <div class="col-xs-6">
                    <?= $form->field($orden, 'responsable',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($orden, 'telefono',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50]) ?>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong class="panel-title">Datos de Orden</strong>
                </div>
                <div class="panel-body" style="overflow: auto;">
                    <?php echo $this->render('detalleOrden',['detalle'=>$detalle,'orden'=>$orden,'form'=>$form]);?>
                    <?php //$this->renderPartial('forms/detalleOrden',array('detalle'=>$detalle,'venta'=>$venta,'form'=>$form));?>
                </div>
            </div>

            <div class="form-group">
                <div class="text-center">
                    <?php //echo CHtml::link('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
                    <?= Html::submitButton($orden->isNewRecord ? 'Guardar' : 'Modificar', ['class' => $orden->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
<?php
//$this->renderPartial('/scripts/cliente');
