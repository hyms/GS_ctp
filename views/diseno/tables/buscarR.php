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
                    'header'=>'Tipo Reposicion',
                    'value'=>function($model){
                        $dato = \app\components\SGOperation::tiposReposicion($model->tipoRepos);
                        return "";
                    },
                ],
                [
                    'header'=>'Fecha',
                    'value'=>'fechaGenerada',
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
                            $url = Url::to(['diseno/reposicion', 'tipo' => 3, 'id' => $model->idOrdenCTP]);
                            if (empty($model->fechaCierre))
                                return Html::a("<i class=\"glyphicon glyphicon-remove-circle text-danger\"></i>", $url, $options);
                            else
                                return "";
                        },
                        'print'=>function($url,$model){
                            $options = array_merge([
                                                       //'class'=>'btn btn-success',
                                                       'data-original-title'=>'Imprimir',
                                                       'data-toggle'=>'tooltip',
                                                       'title'=>''
                                                   ]);
                            $url = Url::to(['diseno/print','op'=>"reposicion",'id'=>$model->idOrdenCTP]);
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