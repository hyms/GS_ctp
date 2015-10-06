<?php
    use kartik\helpers\Html;
    use kartik\widgets\TypeaheadBasic;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;


    echo Html::beginTag('div',['class'=>'row']);

    echo Html::tag('div',
                   Html::panel(
                       [
                           'heading' => Html::tag('strong','Productos',['class'=>'panel-title']),
                           'postBody' => $this->render('../tables/producto',[
                               'producto'=>$producto,
                               'tipo'=>$orden->tipoOrden,
                           ])
                       ],
                       Html::TYPE_DEFAULT
                   ),
                   ['class'=>'col-md-3']);

    echo Html::beginTag('div',['class'=>'col-md-9']);
    echo Html::beginTag('div',['class'=>'well well-sm']);

    echo Html::tag('div',
                   Html::tag('h4',
                             Html::tag('strong','Orden '.(($orden->tipoOrden==0)?'de Trabajo':'Interna')),
                             ['class'=>'col-xs-4']).
                   Html::tag('h4',
                             Html::tag('strong',$orden->correlativo),
                             ['class'=>'col-xs-4 text-center']).
                   Html::tag('h4',
                             Html::tag('strong',date("d/m/Y",strtotime($orden->fechaGenerada))),
                             ['class'=>'col-xs-4 text-right']),
                   ['class'=>'row']);

    $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'form']);

    echo Html::beginTag('div',['class'=>'row']);
    if($orden->tipoOrden==0) {
        echo Html::beginTag('div', ['class' => 'col-xs-6']);
        $data = ArrayHelper::map(\app\models\Cliente::findAll(['fk_idSucursal' => $orden->fk_idSucursal]), 'idCliente', 'nombreNegocio');
        if (empty($data)) {
            echo $form->field($orden, 'responsable', ['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])
                ->textInput(['maxlength' => 50]);
        } else {
            echo $form->field($orden, 'responsable', ['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])
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
                                }); }',
                    ]
                ]);
        }
        echo Html::endTag('div');

        echo Html::tag('div',
                       $form->field($orden,
                                    'telefono',
                                    [
                                        'template' => Html::tag('div', '{label}', ['class' => 'col-xs-4']) .
                                            Html::tag('div', '{input}{error}{hint}', ['class' => 'col-xs-8'])
                                    ])
                           ->textInput(['maxlength' => 50, 'id' => 'telefono']),
                       ['class' => 'col-xs-6']);
    } else {
        echo Html::tag('div',
                       $form->field($orden,
                                    'responsable',
                                    ['template' => Html::tag('div', '{label}', ['class' => 'col-xs-4']) .
                                        Html::tag('div', '{input}{error}{hint}', ['class' => 'col-xs-8'])
                                    ])
                           ->textInput(['maxlength' => 50])->label('Cliente'),
                       ['class' => 'col-xs-6']).
            Html::tag('div',
                      $form->field($orden,
                                   'codDependiente',
                                   ['template' => Html::tag('div', '{label}', ['class' => 'col-xs-4']) .
                                       Html::tag('div', '{input}{error}{hint}', ['class' => 'col-xs-8'])
                                   ])
                          ->textInput(['maxlength' => 50])->label('O.Imprenta'),
                      ['class' => 'col-xs-6']);
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
        Html::a( Html::icon('floppy-remove').' Cancelar', "#", ['class' => 'btn btn-default hidden-print','id'=>'reset']).
        Html::a( Html::icon('floppy-disk').' Guardar', "#", ['class' => 'btn btn-success hidden-print','id'=>'save']);
    if($orden->tipoOrden==1 && !empty($orden->idOrdenCTP)) {
        echo Html::hiddenInput('anular', '0', ['id' => 'anular']) .
            Html::a(Html::icon('remove') . ' Anular', "#", ['class' => 'btn btn-danger hidden-print', 'id' => 'nuller']) .
            $this->render('../scripts/anular');
    }
    echo Html::endTag('div').
        Html::endTag('div');

    ActiveForm::end();
    echo Html::endTag('div');
    echo Html::endTag('div');

    echo Html::endTag('div');
    echo $this->render('../scripts/save');
    echo $this->render('../scripts/reset');
