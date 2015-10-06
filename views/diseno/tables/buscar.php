<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;

    $columns = [
        [
            'header'=>'Correlativo',
            'value'=>'correlativo',
        ],
        /*[
            'header'=>'Cliente',
            'value'=>'$model->correlativo',
        ],*/
        [
            'header'=>'Responsable',
            'value'=>'responsable',
        ],
        [
            'header'=>'Telefono',
            'value'=>'telefono',
        ],
        [
            'header'=>'Fecha',
            'value'=>function($model)
            {
                return date("Y-m-d H:i",strtotime($model->fechaGenerada));
            }
        ],
        [
            'header'=>'',
            'format'=>'raw',
            'value'=>function($model){
                return Html::a(Html::icon('pencil'),['diseno/orden','op'=>'cliente','id'=>$model->idOrdenCTP],['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
            },
        ],

    ];

    echo Html::panel(
        [
            'heading' => Html::tag('strong','Ordenes de trabajo en processo',['class'=>'panel-title']),
            'postBody' => GridView::widget([
                                               'dataProvider'=> $orden,
                                               //'filterModel' => $searchModel,
                                               'columns' => $columns,
                                               'responsive'=>true,
                                               'hover'=>true,
                                               'bordered'=>false
                                           ])
        ],
        Html::TYPE_DEFAULT
    );