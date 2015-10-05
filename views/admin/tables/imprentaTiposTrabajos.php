<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    echo Html::beginTag('div',['class'=>'panel panel-default']);

    echo Html::tag('div', Html::tag('strong','Lista de Tipos de Trabajo',['class'=>'panel-title']), ['class'=>'panel-heading']);

    echo Html::beginTag('div',['class'=>'panel-body']);
    echo Html::button('Nuevo Tipo de Trabajo',
                      [
                          'class'=>'btn btn-default',
                          'onclick' => 'clickmodal("' . Url::to(['admin/config','op'=>'imprenta','imp'=>'tdt','id'=>'f']) . '","Nuevo Tipo de Trabajo")',
                          'data-toggle' => "modal",
                          'data-target' => "#modal"
                      ]);
    echo Html::endTag('div');

    $columns = [
        [
            'header'=>'Nombre',
            'value'=>'nameValue',
        ],
        [
            'header'=>'Observaciones',
            'value'=>'observaciones',
        ],
        [
            'header'=>'Habalitidato',
            'value'=>function($model){
                return ($model->enable)?"Si":"No";
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
                                       'onclick'     => 'clickmodal("' . Url::to(['admin/config','op'=>'imprenta','imp'=>'tdt','id'=>$model->idImprentaTipoTrabajo]) . '","Modificar Tipo de Trabajo")',
                                       'data-toggle' => "modal",
                                       'data-target' => "#modal"
                                   ]);
                },
            ]
        ],
    ];
    Pjax::begin(['id' => 'tipoTrabajos']);
    echo GridView::widget([
                              'dataProvider'=> $search,
                              //'filterModel' => $search,
                              'columns' => $columns,
                              'responsive'=>true,
                              'condensed'=>true,
                              'hover'=>true,
                              'bordered'=>false,
                          ]);
    Pjax::end();
    echo Html::endTag('div');