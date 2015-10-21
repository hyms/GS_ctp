<?php
use kartik\helpers\Html;
use kartik\widgets\DatePicker;
use yii\bootstrap\ActiveForm;

$this->title = 'Venta-Orden'
?>

    <div class="row">
        <div class="col-md-4">
            <?= Html::panel(
                [
                    'heading' => Html::tag('strong','Clientes',['class'=>'panel-title']),
                    'postBody' => $this->render('../tables/cliente',['cliente'=>$clientes,'search'=>$search,'idOrdenCTP'=>$orden->idOrdenCTP]),
                ],
                Html::TYPE_DEFAULT
            );?>


        </div>
        <div class="col-md-8">
            <div class="well well-sm">
                <div class = "row">
                    <h4 class="col-md-4">
                        <?= Html::tag('strong','Orden de Trabajo'); ?>
                    </h4>
                    <h4 class="col-md-4 text-center">
                        <?= Html::tag('strong',$orden->correlativo); ?>
                    </h4>
                    <h4 class="col-md-4 text-right">
                        <?= Html::tag('strong',date("d/m/Y",strtotime($orden->fechaCobro))); ?>
                    </h4>
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
                        <h1 class="text-uppercase"><?= Html::bsLabel(((empty($orden->fk_idCliente))?"-":$orden->fkIdCliente->codigoCliente),'',['id'=>'categoria'])?></h1>
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

                <?= Html::panel(
                    [
                        'heading' => Html::tag('strong','Datos de Orden',['class'=>'panel-title']),
                        'postBody' => $this->render('detalleOrden',['detalle'=>$detalle]),
                    ],
                    Html::TYPE_DEFAULT
                );?>

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

                    <div class="col-md-4">
                        <?= Html::label('Fecha Plazo','fechaPlazo') ?>
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
                        <?= Html::a( Html::icon('floppy-remove').' Cancelar', "#", ['class' => 'btn btn-danger','onClick'=>'previous()']); ?>
                        <?php
                            $hora = strtotime($orden->fechaCobro)+1200; //20 mins para espera de los botones
                            if(strtotime(date("Y-m-d H:i:s"))<=$hora) {
                                echo Html::a( Html::icon('floppy-disk').' Guardar', "#", ['class' => 'btn btn-success','onClick'=>'save()']);
                                if($orden->estado!=1)
                                    echo Html::a( Html::icon('refresh').' Retorno', "#", ['class' => 'btn btn-info', 'onClick' => 'nullResend("2")']);
                            }
                            echo Html::hiddenInput('anular','0',['id'=>'anular']);
                            if($orden->estado!=1)
                                echo Html::a(Html::icon('remove').' Anular', "#", ['class' => 'btn btn-danger', 'onClick' => 'nullResend("1")']);
                        ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php
    $script  =<<<JS
function clienteName(val)
{
	if(val=='')
	{
		$('#idCliente').val('');
		$('#categoria').html('-');
	}
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);
    echo $this->render('@app/views/share/scripts/save');
    echo $this->render('@app/views/share/scripts/reset');
    echo $this->render('../scripts/operaciones');
    echo $this->render('../scripts/totalVenta');
    echo $this->render('../scripts/detalleVenta');
    echo $this->render('../scripts/anular');
    echo $this->render('../scripts/condicionesVenta');