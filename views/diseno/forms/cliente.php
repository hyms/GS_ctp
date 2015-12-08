<?php
use kartik\helpers\Html;
use kartik\widgets\TypeaheadBasic;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>
    <div class="row">
        <div class="col-md-3">
            <?= $this->render('../tables/producto',[
                'producto'=>$producto,
                'tipo'=>$orden->tipoOrden,
            ]); ?>
        </div>
        <div class="col-md-9">
            <div class="well well-sm">

                <?php if(Yii::$app->session->hasFlash('error')) {
                    echo Alert::widget([
                        'options' => [
                            'class' => 'alert-danger',
                        ],
                        'body'    => Yii::$app->session->getFlash('error'),
                    ]);
                }
                ?>
                <div class="row">
                    <h4 class="col-sm-4">
                        <?= Html::tag('strong','Orden '.(($orden->tipoOrden==0)?'de Trabajo':'Interna')); ?>
                    </h4>
                    <h4 class="col-sm-4 text-center">
                        <?= Html::tag('strong',$orden->correlativo); ?>
                    </h4>
                    <h4 class="col-sm-4 text-right">
                        <?= Html::tag('strong',date("d/m/Y",strtotime($orden->fechaGenerada))); ?>
                    </h4>

                </div>
                <?php
                    $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'form']);

                    echo Html::beginTag('div',['class'=>'row']);
                    echo Html::hiddenInput('cantidad',count($detalle),['id'=>'cantidad']);
                    if($orden->tipoOrden==0) {
                        echo Html::beginTag('div', ['class' => 'col-sm-6']);
                        $data = ArrayHelper::map(\app\models\Cliente::findAll(['fk_idSucursal' => $orden->fk_idSucursal]), 'idCliente', 'nombreNegocio');
                        if (empty($data)) {
                            echo $form->field($orden, 'responsable',
                                              ['template' => Html::tag('div', '{label}', ['class' => 'col-sm-4']) .
                                                  Html::tag('div', '{input}{error}{hint}', ['class' => 'col-sm-8'])])
                                ->textInput(['maxlength' => 50]);
                        } else {
                            echo $form->field($orden, 'responsable',
                                              ['template' => Html::tag('div', '{label}', ['class' => 'col-sm-4']) .
                                                  Html::tag('div', '{input}{error}{hint}', ['class' => 'col-sm-8'])])
                                ->textInput(['maxlength' => 50])
                                ->widget(TypeaheadBasic::classname(), [
                                    'data'          => $data,
                                    'options'       => ['placeholder' => 'Nombre del Negocio'],
                                    'pluginOptions' => ['highlight' => true],
                                    'pluginEvents'  => [
                                        'typeahead:selected' => 'function(obj, selected, name) {
                                            $.ajax({
                                                url: "' . Url::to(['diseno/cliente']) . '",
                                                type: "post",
                                                data: "name="+selected.toString(),
                                                success: function(data) {
                                                    $("#telefono").val(data);
                                                    $("#telefono").focus();
                                                }
                                            });
                                        }',
                                    ]
                                ]);
                        }

                        echo Html::endTag('div');

                        echo Html::tag('div',
                                       $form->field($orden,
                                                    'telefono',
                                                    [
                                                        'template' => Html::tag('div', '{label}', ['class' => 'col-sm-4']) .
                                                            Html::tag('div', '{input}{error}{hint}', ['class' => 'col-sm-8'])
                                                    ])
                                           ->textInput(['maxlength' => 50, 'id' => 'telefono']),
                                       ['class' => 'col-sm-6']);
                    } else {
                        echo Html::tag('div',
                                       $form->field($orden,
                                                    'responsable',
                                                    ['template' => Html::tag('div', '{label}', ['class' => 'col-sm-4']) .
                                                        Html::tag('div', '{input}{error}{hint}', ['class' => 'col-sm-8'])
                                                    ])
                                           ->textInput(['maxlength' => 50])->label('Cliente'),
                                       ['class' => 'col-sm-6']).
                            Html::tag('div',
                                      $form->field($orden,
                                                   'codDependiente',
                                                   ['template' => Html::tag('div', '{label}', ['class' => 'col-sm-4']) .
                                                       Html::tag('div', '{input}{error}{hint}', ['class' => 'col-sm-8'])
                                                   ])
                                          ->textInput(['maxlength' => 50])->label('O.Imprenta'),
                                      ['class' => 'col-sm-6']);
                    }
                    echo Html::endTag('div');

                    echo Html::panel(
                        [
                            'heading' => Html::tag('strong','Datos de Orden',['class'=>'panel-title']),
                            'postBody' => $this->render('detalleOrden',['detalle'=>$detalle,'orden'=>$orden])
                        ],
                        Html::TYPE_DEFAULT
                    );

                    echo $form->field($orden, 'observaciones')->textArea();

                    echo Html::beginTag('div',['class'=>'form-group']).
                        Html::beginTag('div',['class'=>'text-center']).
                        Html::a( Html::icon('floppy-remove').' Cancelar', "#", ['class' => 'btn btn-default','onClick'=>'previous()']).
                        Html::a( Html::icon('floppy-disk').' Guardar', "#", ['class' => 'btn btn-success','onClick'=>'save()']);
                    if($orden->tipoOrden==1 && !empty($orden->idOrdenCTP)) {
                        echo Html::hiddenInput('anular', '0', ['id' => 'anular']) .
                            Html::a(Html::icon('remove') . ' Anular', "#", ['class' => 'btn btn-danger hidden-print', 'onClick' => 'nuller()']) .
                            $this->render('../scripts/anular');
                    }
                    echo Html::endTag('div').
                        Html::endTag('div');

                    ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
<?php
    //echo $this->render('../scripts/save');
    echo $this->render('@app/views/share/scripts/save');
    echo $this->render('@app/views/share/scripts/reset');

