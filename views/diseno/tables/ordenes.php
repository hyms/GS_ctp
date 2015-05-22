<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Historial de ordenes de trabajo</strong>
    </div>
    <div>
        <?php
            /*$data =  new ActiveDataProvider([
                                                'query'      => $orden,
                                                'pagination' => [
                                                    'pageSize' => 10,
                                                ],
                                            ]);
*/
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
                    'attribute'=>function($model)
                    {
                        echo $model->fkIdUserD->nombre." ".$model->fkIdUserD->apellido;
                    }
                ],
                [
                    'header'=>'Fecha',
                    'attribute'=>'fechaGenerada',
                    /*'filter' => DatePicker::widget(
                        ['language' => 'es',
                         'type' => DatePicker::TYPE_INPUT,
                         'name' => 'fechaGenerada',
                         'pluginOptions' =>
                             [
                                 'autoclose'=>true,
                                 'format' => 'yyyy-mm-dd'
                             ]
                        ]
                    ),
                    'format' => 'html',*/
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{print}',
                    'buttons'=>[
                        'print'=>function($url,$model){
                            $options = array_merge([
                                                       //'class'=>'btn btn-success',
                                                       'data-original-title'=>'Imprimir',
                                                       'data-toggle'=>'tooltip',
                                                       'title'=>''
                                                   ]);
                            $url = Url::to(['diseno/print','op'=>'orden','id'=>$model->idOrdenCTP]);
                            return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                        },
                    ]
                ],
            ];
            echo GridView::widget([
                                      'dataProvider'=> $orden,
                                      'filterModel' => $search,
                                      'columns' => $columns,
                                      'responsive'=>true,
                                      'condensed'=>true,
                                      'hover'=>true,
                                      'bordered'=>false,
                                      'pjax'=>true,
                                  ]);
        ?>
    </div>
</div>