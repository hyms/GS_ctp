<?php
    use kartik\grid\GridView;
    use yii\data\ActiveDataProvider;
    use yii\helpers\Html;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo Pendientes</strong>
    </div>
    <div style="overflow: auto">
        <?php
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
                    //'header'=>'fechaGenerada',
                    'attribute'=>'fechaGenerada',
                ],
                [
                    'header'=>'',
                    'format'=>'raw',
                    'value'=>function($model){
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                                       ['venta/venta','id'=>$model->idOrdenCTP],
                                       [
                                           'class'=>"update",
                                           'title'=>"",
                                           'data-toggle'=>"tooltip",
                                           'data-original-title'=>"Modificar",
                                       ]);
                    },
                ],
            ];
            echo GridView::widget([
                                      'dataProvider'=> $data,
                                      //'filterModel' => $searchModel,
                                      'columns' => $columns,
                                      'responsive'=>true,
                                      'hover'=>true
                                  ]);
        ?>
    </div>
</div>
