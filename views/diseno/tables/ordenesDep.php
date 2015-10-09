<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

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
                      'format'=>'raw',
                      'value'=>function($model){
                          return Html::a(Html::icon('print'),
                                         Url::to(['diseno/print','op'=>'orden','id'=>$model->idOrdenCTP]),
                                         [
                                             //'class'=>'btn btn-success',
                                             'data-toggle'=>'tooltip',
                                             'target' => '_blank',
                                             'title'=>(($model->estado<0)?'ANULADO':'Imprimir')
                                         ]);
                      }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{print} {view} {validate}',
                        'buttons'=>[
                            'validate'=>function($url,$model){
                                $options = array_merge([
                                                           //'class'=>'btn btn-success',
                                                           'data-toggle'=>'tooltip',
                                                           'class'=>'btn btn-success',
                                                           'title'=>'Validar',
                                                           'onclick'             => "validar(".$model->idOrdenCTP.",'".Url::to(['diseno/dependientes'])."'); return false;"
                                                       ]);
                                if(empty($model->fk_idUserD2))
                                    return Html::a(Html::icon('check'), '#', $options);
                                else
                                    return "";
                            },
                            'print'=>function($url,$model){
                                $options = array_merge([
                                                           //'class'=>'btn btn-success',
                                                           'data-toggle'=>'tooltip',
                                                           'target' => '_blank',
                                                           'title'=>(($model->estado<0)?'ANULADO':'Imprimir')
                                                       ]);
                                $url = Url::to(['diseno/print','op'=>'orden','id'=>$model->idOrdenCTP]);
                                return Html::a(Html::icon('print'), $url, $options);
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
                Pjax::begin();
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
                Pjax::end();
            ?>
        </div>
    </div>
