<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

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
                    return Html::a(Html::icon('pencil') . ' Modificar',
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
                              'toolbar' =>  [
                                  [
                                      'content'=>Html::button('Nuevo Usuario',
                                                              [
                                                                  'class'=>'btn btn-default',
                                                                  'onclick' => 'clickmodal("' . Url::to(['admin/config','op'=>'user','frm'=>true]) . '","Nuevo Usuario")',
                                                                  'data-toggle' => "modal",
                                                                  'data-target' => "#modal"
                                                              ]),
                                  ]
                              ],
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' => Html::tag('strong','Lista de Usuarios'),
                              ],
                          ]);
    Pjax::end();
