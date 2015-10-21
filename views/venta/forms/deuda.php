<?php
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\ArrayDataProvider;

?>
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::tag('strong','Orden de Trabajo',['class'=>'panel-title']); ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= Html::tag('strong','Cliente:').' '. ((!empty($orden->fk_idCliente))?$orden->fkIdCliente->nombreNegocio:""); ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::tag('strong','NitCi:').' '. ((!empty($orden->fk_idCliente))?$orden->fkIdCliente->nitCi:""); ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::tag('strong','Responsable:').' '. $orden->responsable; ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::tag('strong','Telefono:').' '. $orden->telefono; ?>
                    </div>
                </div>
                <?php
                    $data = new ArrayDataProvider();
                    $data->models = $orden->ordenDetalles;
                    $columns = [
                        [
                            'class'=>'kartik\grid\SerialColumn',
                            'header'=>'Nro.',
                        ],
                        [
                            'header'=>'Formato',
                            'value'=>function($model){
                                return $model->fkIdProductoStock->fkIdProducto->formato;
                            }
                        ],
                        [
                            'header'=>'Cant.',
                            'value'=>'cantidad'
                        ],
                        [
                            'header'=>'Colores',
                            'format'=>'raw',
                            'value'=>function($model)
                            {
                                return (($model->C)?Html::tag('strong','C'):'').
                                (($model->M)?Html::tag('strong','M'):'').
                                (($model->Y)?Html::tag('strong','Y'):'').
                                (($model->K)?Html::tag('strong','K'):'');
                            }
                        ],
                        [
                            'header'=>'Trabajo',
                            'value'=>'trabajo',
                        ],
                        [
                            'header'=>'Pinza',
                            'value'=>'pinza',
                        ],
                        [
                            'header'=>'Resol.',
                            'value'=>'resolucion',
                        ],
                        [
                            'header'=>'Costo',
                            'value'=>'costo',
                        ],
                        [
                            'header'=>'Adic.',
                            'value'=>'adicional',
                        ],
                        [
                            'header'=>'Total',
                            'value'=>'total',
                        ],

                    ];
                    echo GridView::widget([
                                              'dataProvider'=> $data,
                                              'columns' => $columns,
                                              'responsive'=>true,
                                              'condensed'=>true,
                                              'hover'=>true,
                                              'bordered'=>false,
                                              'layout'=>'{items}'
                                          ]);
                ?>
                <div class="well well-sm col-md-2 col-md-offset-10">
                    <?= Html::tag('strong','Total:').' '. $orden->montoVenta; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <?= Html::panel(
            [
                'heading' => Html::tag('strong','Deuda Hasta el momento',['class'=>'panel-title']),
                'body' => Html::tag('div',
                                    Html::tag('strong','Cancelado:').' '.$deuda,
                                    ['class'=>'col-md-6']).
                    Html::tag('div',
                              Html::tag('strong','Saldo:').' '.($orden->montoVenta-$deuda),
                              ['class'=>'col-md-6']),
            ],
            Html::TYPE_DEFAULT
        );?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::tag('strong','A Cancelar',['class'=>'panel-title']); ?>
            </div>
            <div class="panel-body">

                <?php $form = ActiveForm::begin(['id'=>'form']);?>
                <div class="row">
                    <?= Html::hiddenInput('montoVenta',$orden->montoVenta,['id'=>'total']); ?>
                    <?= Html::hiddenInput('montoPagado',$deuda,['id'=>'pagado']); ?>
                    <div class="col-md-6">
                        <?= $form->field($model,'monto')->textInput(['id'=>'acuenta']); ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::label('Saldo','saldo'); ?>
                        <?= Html::textInput('saldo',null,['class'=>'form-control','id'=>'saldo']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <?= Html::a( Html::icon('floppy-remove').' Cancelar', "#", ['class' => 'btn btn-danger','onClick'=>'previous()']); ?>
                        <?= Html::a( Html::icon('floppy-disk').' Guardar', "#", ['class' => 'btn btn-success','onClick'=>'save()']); ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
<?php
    $script = <<<JS
    $('#acuenta').keydown(function(e) {
        if (e.keyCode == 13 || e.keyCode == 9) {
            $('#saldo').val(resta($('#total').val(), suma($('#acuenta').val(),$('#pagado').val())));
        }
    });
    $('#acuenta').blur(function(e) {
        $('#saldo').val(resta($('#total').val(), suma($('#acuenta').val(),$('#pagado').val())));
    })
JS;

    $this->registerJs($script, \yii\web\View::POS_READY);

    echo $this->render('../scripts/operaciones');
    echo $this->render('@app/views/share/scripts/save');
    echo $this->render('@app/views/share/scripts/reset');
