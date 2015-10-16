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
            'header'=>'Usuario',
            'attribute'=>'nombreUsuario',
            'value'=>function($model){
                return $model->fkIdUserD->nombre." ".$model->fkIdUserD->apellido;
            },
        ],
        [
            'header'=>'Cliente',
            'attribute'=>'responsable',
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
            'template'=>'{update} {print}',
            'buttons'=>[
                'update'=>function($url,$model) {
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title' => 'Modificar',
                                               'data-toggle' => 'tooltip',
                                               'title' => '',
                                               'target'=>'_blank',
                                           ]);
                    $url = Url::to(['diseno/interna','op' => 'nueva', 'id' => $model->idOrdenCTP]);
                    if (empty($model->fechaCierre))
                        return Html::a(Html::icon('pencil'), $url, $options);
                    else
                        return "";
                },
                'print'=>function($url,$model){
                    $url = Url::to(['diseno/print','op'=>'interna','id'=>$model->idOrdenCTP]);
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Imprimir',
                                               'data-toggle'=>'tooltip',
                                               'data-target' => "#modalPage",
                                               'title'=>'',
                                               'onClick'=>'printView("'.$url.'")'
                                           ]);

                    return Html::a(Html::icon('print'), '#', $options);
                },
            ]
        ],
    ];

    Pjax::begin();
    echo Html::panel(
        [
            'heading' => Html::tag('strong','Ordenes Internas',['class'=>'panel-title']),
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