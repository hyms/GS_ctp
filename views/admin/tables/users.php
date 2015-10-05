<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    echo Html::beginTag('div',['class'=>'panel panel-default']);

    echo Html::tag('div', Html::tag('strong','Lista de Usuarios',['class'=>'panel-title']), ['class'=>'panel-heading']);

    echo Html::beginTag('div',['class'=>'panel-body']);
    echo Html::button('Nuevo Usuario',
                      [
                          'class'=>'btn btn-default',
                          'onclick' => 'clickmodal("' . Url::to(['admin/config','op'=>'user','frm'=>true]) . '","Nuevo Usuario")',
                          'data-toggle' => "modal",
                          'data-target' => "#modal"
                      ]);
    echo Html::endTag('div');

        $columns = [
            [
                'header'=>'Nombre',
                'value'=>'nombre',
            ],
            [
                'header'=>'Apellido',
                'value'=>'apellido',
            ],
            [
                'header'=>'CI',
                'value'=>'CI',
            ],
            [
                'header'=>'Telefono',
                'value'=>'telefono',
            ],
            [
                'header'=>'Surcursal',
                'value'=>function($model){
                    return $model->fkIdSucursal->nombre;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update'=>function($url,$model) {
                        return Html::a(Html::tag('span', '',
                                                 [
                                                     'class' => 'glyphicon glyphicon-import',
                                                 ]
                                       ) . ' Modificar',
                                       "#",
                                       [
                                           'onclick'     => 'clickmodal("' . Url::to(['admin/config','op'=>'user','id'=>$model->idUser,'frm'=>true]) . '","Usuario '.$model->nombre.' '.$model->apellido.'")',
                                           'data-toggle' => "modal",
                                           'data-target' => "#modal"
                                       ]);
                    },
                ]
            ],
        ];
    Pjax::begin(['id' => 'usuarios']);
        echo GridView::widget([
                                  'dataProvider'=> $usuarios,
                                  //'filterModel' => $search,
                                  'columns' => $columns,
                                  'responsive'=>true,
                                  'condensed'=>true,
                                  'hover'=>true,
                                  'bordered'=>false,
                              ]);
    Pjax::end();
    echo Html::endTag('div');