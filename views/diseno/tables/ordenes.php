<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    $columns = [
        [
            'header'=>'Correlativo',
            'attribute'=>'correlativo',
        ],
        [
            'header'=>'Responsable',
            'attribute'=>'responsable',
        ],
        [
            'header'=>'Telefono',
            'attribute'=>'telefono',
        ],
        [
            'header'=>'Operador',
            'attribute'=>'nombreUsuario',
            'value'=>function($model)
            {
                return $model->fkIdUserD->nombre." ".$model->fkIdUserD->apellido;
            }
        ],
        [
            'header'=>'Fecha',
            'attribute'=>'fechaGenerada',
            'value'=>function($model)
            {
                return date("Y-m-d H:i",strtotime($model->fechaGenerada));
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{view}',
            'buttons'=>[
                'view'=>function($url,$model) {
                    return Html::a(Html::icon('eye-open'),
                                   "#",
                                   [
                                       'onclick'     => 'clickmodal("' . Url::to(['diseno/review','op'=>'cliente','id'=>$model->idOrdenCTP]) . '","Orden de Trabajo '.$model->correlativo.'")',
                                       'data-toggle' => "tooltip",
                                       'data-target' => "#modal",
                                       'data-original-title' => 'Ver Orden de Trabajo',
                                   ]);
                },
            ]
        ],
    ];

    Pjax::begin();
    echo GridView::widget([
                              'dataProvider'=> $orden,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'toolbar' =>  [],
                              // set export properties
                              'responsive'=>true,
                              'hover'=>true,
                              'bordered'=>false,
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' =>Html::tag('strong','Historial de ordenes de trabajo'),
                              ],
                          ]);
    Pjax::end();
