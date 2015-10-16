<?php
    use app\components\SGOperation;
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
            'header'=>'Tipo Reposicion',
            'attribute'=>'tipoRepos',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>SGOperation::tiposReposicion(),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Seleccionar'],
            'format'=>'raw',
            'value'=>function($model) {
                $dato = SGOperation::tiposReposicion($model->tipoRepos);
                if (!is_array($dato))
                    return $dato;
                return "";
            },
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
            'template'=>'{nulled} {print}',
            'buttons'=>[
                'nulled'=>function($url,$model) {
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title' => 'Anular',
                                               'data-toggle' => 'tooltip',
                                               'title' => ''
                                           ]);
                    $url = Url::to(['diseno/reposicion', 'tipo' => 5, 'id' => $model->idOrdenCTP]);
                    if (empty($model->fechaCierre) && ($model->estado >=0))
                        return Html::a(Html::icon('remove-circle',['class'=>'text-danger']), $url, $options);
                    else
                        return "";
                },
                'print'=>function($url,$model) {
                    $url     = Url::to(['diseno/print', 'op' => "reposicion", 'id' => $model->idOrdenCTP]);
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-toggle' => 'tooltip',
                                               'data-target' => "#modalPage",
                                               'onClick'     => 'printView("' . $url . '")',
                                               'title'       => 'Imprimir'
                                           ]);

                    return Html::a(Html::icon('print'), '#', $options);
                },
            ]
        ],
    ];

    Pjax::begin();
    echo Html::panel(
        [
            'heading' => Html::tag('strong','Reposiciones',['class'=>'panel-title']),
            'postBody' => GridView::widget([
                                               'dataProvider'=> $orden,
                                               'filterModel' => $search,
                                               'columns' => $columns,
                                               'responsive'=>true,
                                               'hover'=>true,
                                               'rowOptions' => function ($model, $index, $widget, $grid){
                                                   if($model->estado<0){
                                                       return ['class' => GridView::TYPE_DANGER];
                                                   }else{
                                                       return [];
                                                   }
                                               },
                                           ])
        ],
        Html::TYPE_DEFAULT
    );
    Pjax::end();

    echo $this->render('@app/views/share/scripts/modalPage');
