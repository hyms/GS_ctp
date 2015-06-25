<?php
use kartik\widgets\TypeaheadBasic;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-xs-3">
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

    <div class="col-xs-9">
        <div class="well well-sm">
            <div class = "row">
                <h4 class="col-xs-4"><strong>Orden <?= ($orden->tipoOrden==0)?"de Trabajo":"Interna" ?></strong></h4>
                <h4 class="col-xs-4 text-center"><strong><?= $orden->correlativo;?></strong></h4>
                <h4 class="col-xs-4 text-right"><strong><?= date("d/m/Y",strtotime($orden->fechaGenerada));?></strong></h4>
            </div>

            <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'form']); ?>
            <div class="row">
                <?php if($orden->tipoOrden==0){?>
                    <div class="col-xs-6">
                        <?php
                            $data = ArrayHelper::map(\app\models\Cliente::findAll(['fk_idSucursal'=>$orden->fk_idSucursal]),'idCliente','nombreNegocio');
                            if(empty($data))
                            {
                                echo $form->field($orden, 'responsable', ['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])
                                    ->textInput(['maxlength' => 50]);
                            }
                            else {
                                echo $form->field($orden, 'responsable', ['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])
                                    ->textInput(['maxlength' => 50])
                                    ->widget(TypeaheadBasic::classname(), [
                                        'data'          => $data,
                                        'options'       => ['placeholder' => 'Nombre del Negocio'],
                                        'pluginOptions' => ['highlight' => true],
                                        'pluginEvents'  => [
                                            'typeahead:selected' => 'function(event,suggestion) {
                                    $.ajax({
                                        url: "' . Url::to(['diseno/cliente']) . '",
                                        type: "post",
                                        data: "name="+suggestion["value"],
                                        success: function(data) {
                                            $("#telefono").val(data);
                                        }
                                }); }',
                                        ]
                                    ]);
                            }
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?= $form->field($orden, 'telefono',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50,'id'=>'telefono']) ?>
                    </div>
                <?php }else{ ?>
                    <div class="col-xs-6">
                        <?= $form->field($orden, 'responsable',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])
                            ->textInput(['maxlength' => 50])->label('Cliente');
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?= $form->field($orden, 'codDependiente',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])
                            ->textInput(['maxlength' => 50])->label('O.Imprenta');
                        ?>
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
                    <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
                    <?= Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-success hidden-print','id'=>'save')); ?>
					<?php
					if($orden->tipoOrden==1 && !empty($orden->idOrdenCTP)) {
                        echo Html::hiddenInput('anular', '0', ['id' => 'anular']);
                        echo Html::a('<span class="glyphicon glyphicon-remove"></span> Anular', "#", array('class' => 'btn btn-danger hidden-print', 'id' => 'nuller'));
                        echo $this->render('../scripts/anular');
                    }
					?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?= $this->render('../scripts/save') ?>
<?= $this->render('../scripts/reset') ?>
