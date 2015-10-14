<?php
    use kartik\helpers\Html;
    use kartik\widgets\DatePicker;
    use yii\bootstrap\ActiveForm;

    //use yii\helpers\Html;

    $this->title = 'Venta-Orden'
?>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><strong class="panel-title">Clientes</strong></div>
                <?= $this->render('../tables/cliente',['cliente'=>$clientes,'search'=>$search,'idOrdenCTP'=>$orden->idOrdenCTP]) ?>
            </div>

        </div>
        <div class="col-md-8">
            <div class="well well-sm">
                <div class = "row">
                    <h4 class="col-md-4"><strong>Orden de Trabajo</strong></h4>
                    <h4 class="col-md-4 text-center"><strong><?= $orden->correlativo;?></strong></h4>
                    <h4 class="col-md-4 text-right"><strong><?= date("d/m/Y",strtotime($orden->fechaCobro));?></strong></h4>
                </div>


                <?php
                    $form = ActiveForm::begin(['id'=>'form']);
                ?>
                <div class="row">
                    <div class="col-md-8">
                        <?php
                            $datoCliente = "";
                            $tipoCliente = "";
                            if(!empty($orden->fk_idCliente)) {
                                $tmpCliente = \app\models\Cliente::findOne(['idCliente' => $orden->fk_idCliente]);
                                if (!empty($tmpCliente))
                                    $datoCliente = $tmpCliente->nombreNegocio . " - " . $tmpCliente->nitCi;
                            }
                        ?>
                        <?= Html::label('Cliente','cliente')?>
                        <?= Html::textarea('cliente',$datoCliente,['class'=>'form-control','id'=>'cliente','onchange'=>'clienteName(this.value)']) ?>
                    </div>
                    <div class="col-md-4 text-center">
                        <?= Html::label('Categoria');?>
                        <h1 class="text-uppercase"><?= Html::bsLabel(((empty($orden->fk_idCliente))?"C":$orden->fkIdCliente->codigoCliente),'',['id'=>'categoria'])?></h1>
                    </div>

                </div>

                <div class="row">
                    <?= $form->field($orden,'fk_idCliente')->hiddenInput(['id'=>'idCliente'])->label(false); ?>
                    <div class="col-md-6">
                        <?= $form->field($orden, 'responsable')->textInput(['maxlength' => 50]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($orden, 'telefono')->textInput(['maxlength' => 50]) ?>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong class="panel-title">Datos de Orden</strong>
                    </div>
                    <div style="overflow: auto">
                        <?= $this->render('detalleOrden',['detalle'=>$detalle]); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <?= Html::label('Diseñador:').' '.$orden->fkIdUserD->nombre.' '.$orden->fkIdUserD->apellido; ?>
                        <?= $form->field($orden, 'observaciones')->textarea(['readOnly'=>true]); ?>
                        <?= $form->field($orden, 'observacionesCaja')->textarea(); ?>
                    </div>

                    <div class="col-md-5">
                        <?= $form->field($orden,'montoVenta')->textInput(['readonly'=>true,'id'=>'total']); ?>
                        <div class="form-group">
                            <?= Html::label("Monto Pagado","monto")?>
                            <?= Html::textInput("monto",$monto,array('class'=>'form-control',"id"=>"pagado")); ?>
                        </div>
                        <div class="form-group">
                            <?= Html::label("Monto Cambio","montoCambio")?>
                            <?= Html::textInput("montoCambio","",array('class'=>'form-control','disabled'=>true,"id"=>"cambio")); ?>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4"><?= '<label class="control-label">Fecha Plazo</label>'; ?>
                        <?= DatePicker::widget([
                                                   'model' => $orden,
                                                   'attribute' => 'fechaPlazo',
                                                   'type' => DatePicker::TYPE_INPUT,
                                                   'options' => ['placeholder' => 'Ingresa fecha plazo','id'=>'fechaPlazo','disabled'=>true],
                                                   'pluginOptions' => [
                                                       'autoclose'=>true,
                                                       'format' => 'yyyy-mm-dd'
                                                   ]
                                               ]); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($orden,'montoDescuento')->textInput(['id'=>'descuento'])?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($orden,'cfSF',['template'=>'{input}'])->checkbox()->label('Con Factura'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
                        <?php
                            $hora = strtotime($orden->fechaCobro)+1200; //20 mins para espera de los botones
                            if(strtotime(date("Y-m-d H:i:s"))<=$hora) {
                                echo Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-success hidden-print', 'id' => 'save'));
                                if($orden->montoVenta!="" || $orden->montoVenta>=0)
                                echo Html::a('<span class="glyphicon glyphicon-refresh"></span> Retorno', "#", array('class' => 'btn btn-info hidden-print', 'id' => 'reenviar'));
                            }
                            echo Html::hiddenInput('anular','0',['id'=>'anular']);
                            if($orden->montoVenta!="" || $orden->montoVenta>=0)
                            echo Html::a('<span class="glyphicon glyphicon-remove"></span> Anular', "#", array('class' => 'btn btn-danger hidden-print', 'id' => 'nuller'));
						?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?= $this->render('../scripts/operaciones') ?>
<?= $this->render('../scripts/totalVenta') ?>
<?= $this->render('../scripts/detalleVenta') ?>
<?= $this->render('../scripts/anular') ?>
<?= $this->render('../scripts/save') ?>
<?= $this->render('../scripts/reset') ?>
<?= $this->render('../scripts/condicionesVenta') ?>
<?php
    $js  ="
        function clienteName(val)
        {
			if(val=='')
			{
				$('#idCliente').val('');
				$('#categoria').html('C');
			}
        }";
    $this->registerJs($js, \yii\web\View::POS_HEAD);
?>