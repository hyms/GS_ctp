<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;

?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Ordenes de trabajo</strong>
        </div>
        <div>
            <?php
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
                        'template'=>'{print} {view} {validate}',
                        'buttons'=>[
                            'validate'=>function($url,$model){
                                $options = array_merge([
                                                           //'class'=>'btn btn-success',
                                                           'data-original-title'=>'Validar',
                                                           'data-toggle'=>'tooltip',
                                                           'title'=>'',
                                                           'onclick'             => "validar(".$model->idOrdenCTP.",'".Url::to(['diseno/dependientes'])."'); return false;"
                                                       ]);
                                if(empty($model->fk_idUserD2))
                                    return Html::a('<span class="glyphicon glyphicon-check btn btn-success btn-sm"></span>', '#', $options);
                                else
                                    return "";
                            },
                            'print'=>function($url,$model){
                                $options = array_merge([
                                                           //'class'=>'btn btn-success',
                                                           'data-original-title'=>(($model->estado<0)?'ANULADO':'Imprimir'),
                                                           'data-toggle'=>'tooltip',
                                                           'title'=>''
                                                       ]);
                                $url = Url::to(['diseno/print','op'=>'orden','id'=>$model->idOrdenCTP]);
                                return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                            },
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
                \yii\widgets\Pjax::begin();
                echo GridView::widget([
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
                                      ]);
                \yii\widgets\Pjax::end();
            ?>
        </div>
    </div>
