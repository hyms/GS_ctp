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
            'template'=>'{print} {validate}',
            'buttons'=>[
                'validate'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-toggle'=>'tooltip',
                                               'class'=>'btn btn-success',
                                               'title'=>'Validar',
                                               'onclick'             => "validar('".Url::to(['diseno/dependientes'])."',".$model->idOrdenCTP."); return false;"
                                           ]);
                    if(empty($model->fk_idUserD2))
                        return Html::a(Html::icon('check'), '#', $options);
                    else
                        return "";
                },
                'print'=>function($url,$model) {
                    $url     = Url::to(['diseno/print', 'op' => 'orden', 'id' => $model->idOrdenCTP]);
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title' => 'Imprimir',
                                               'data-toggle'         => 'tooltip',
                                               'data-target' => "#modalPage",
                                               'title'               => (($model->estado < 0) ? 'ANULADO' : 'Imprimir'),
                                               'onClick'             => 'printView("' . $url . '")'
                                           ]);
                    return Html::a(Html::icon('print'), '#', $options);
                },
                /*'view'=>function($url,$model) {
                    return Html::a(Html::icon('eye-open'),
                                   "#",
                                   [
                                       'onclick'     => 'clickmodal("' . Url::to(['diseno/review','op'=>'cliente','id'=>$model->idOrdenCTP]) . '","Orden de Trabajo '.$model->correlativo.'")',
                                       'data-toggle' => "tooltip",
                                       'data-target' => "#modal",
                                       'data-original-title' => 'Ver Orden de Trabajo',
                                   ]);
                },*/
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
                                               'condensed'=>true,
                                               'hover'=>true,
                                               'bordered'=>false,
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
