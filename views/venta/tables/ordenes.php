<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\data\ActiveDataProvider;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    $data =  new ActiveDataProvider([
                                        'query'      => $orden,
                                        'pagination' => [
                                            'pageSize' => 10,
                                        ],
                                    ]);

    $columns=[
        [
            'header'=>'Correlativo',
            'attribute'=>'correlativo',
        ],
        [
            'header'=>'Diseñador',
            'value'=>function($model){
                return (!empty($model->fkIdUserD))?($model->fkIdUserD->nombre.' '.$model->fkIdUserD->apellido):'';
            },
        ],
        [
            'header'=>'Responsable',
            'attribute'=>'responsable',
        ],
        [
            'header'=>'fechaGenerada',
            'value'=>function($model){
                return date("Y-m-d H:i",strtotime($model->fechaGenerada));
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update} {print}',
            'buttons'=>[
                'update'=>function($url,$model){
                    return Html::a(Html::icon('shopping-cart'),
                                   ['venta/venta','id'=>$model->idOrdenCTP],
                                   [
                                       'class'=>"update",
                                       'title'=>"",
                                       'data-toggle'=>"tooltip",
                                       'data-original-title'=>"Realizar Tranzaccion",
                                   ]);
                },
                'print'=>function($url,$model) {
                    $url     = Url::to(['venta/print', 'op' => 'orden', 'id' => $model->idOrdenCTP]);
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-toggle' => 'tooltip',
                                               'data-target' => "#modal",
                                               'onClick'     => 'printView("' . $url . '")',
                                               'title'       => 'Imprimir'
                                           ]);
                    return Html::a(Html::icon('print'), '#', $options);
                },
            ]
        ],
    ];

    Pjax::begin(['id'=>'pendientes']);
    echo Html::panel(
        [
            'heading' => Html::tag('strong','Ordenes de trabajo Pendientes',['class'=>'panel-title']),
            'postBody' => GridView::widget([
                                               'dataProvider'=> $data,
                                               'columns' => $columns,
                                               'responsive'=>true,
                                               'hover'=>true,
                                               'bordered'=>false,
                                           ])
        ],
        Html::TYPE_DEFAULT
    );
    Pjax::end();

    $script = <<< JS
    $(document).ready(function() {
    setInterval(function(){ $.pjax.reload({container:"#pendientes"}); }, 30000);
});

JS;
    $this->registerJs($script);

    echo $this->render('@app/views/share/scripts/modalPage');