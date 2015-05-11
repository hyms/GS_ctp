<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body">
        <?php
            $columns = [
                [
                    'header'=>'Correlativo',
                    'value'=>'correlativo',
                ],
                [
                    'header'=>'Codigo',
                    'value'=>function($model){
                        return (isset($model->codigoServicio))?$model->codigoServicio:'';
                    },
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
                    'header'=>'Fecha',
                    'value'=>'fechaGenerada',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{update} {print}',
                    'buttons'=>[
                        'update'=>function($url,$model){
                            $options = array_merge([
                                                       //'class'=>'btn btn-success',
                                                       'data-original-title'=>'Modificar',
                                                       'data-toggle'=>'tooltip',
                                                       'title'=>''
                                                   ]);
                            $url = Url::to(['diseno/'.($model->tipoOrden==1)?'interna':'reposicion','op'=>'nueva','id'=>$model->idOrdenCTP]);
                            return Html::a("<i class=\"glyphicon glyphicon-pencil\"></i>",$url,['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
                        },
                        'print'=>function($url,$model){
                            $options = array_merge([
                                                       //'class'=>'btn btn-success',
                                                       'data-original-title'=>'Imprimir',
                                                       'data-toggle'=>'tooltip',
                                                       'title'=>''
                                                   ]);
                            $url = Url::to(['diseno/print','op'=>($model->tipoOrden==1)?'interna':"reposicion",'id'=>$model->idOrdenCTP]);
                            return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                        },
                    ]
                ],
            ];

            echo GridView::widget([
                                      'dataProvider'=> $orden,
                                      //'filterModel' => $searchModel,
                                      'columns' => $columns,
                                      'responsive'=>true,
                                      'hover'=>true
                                  ]);
        ?>
    </div>
</div>