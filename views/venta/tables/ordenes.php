<?php
    use kartik\grid\GridView;
    use yii\data\ActiveDataProvider;
    use yii\helpers\Html;
    use yii\helpers\Url;

    // use yii\widgets\Pjax;

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
                            return Html::a('<i class="glyphicon glyphicon-shopping-cart"></i>',
                                           ['venta/venta','id'=>$model->idOrdenCTP],
                                           [
                                               'class'=>"update",
                                               'title'=>"",
                                               'data-toggle'=>"tooltip",
                                               'data-original-title'=>"Realizar Tranzaccion",
                                           ]);
                        },
                        'print'=>function($url,$model){
                            $options = array_merge([
                                                       //'class'=>'btn btn-success',
                                                       'data-original-title'=>'Imprimir',
                                                       'data-toggle'=>'tooltip',
                                                       'title'=>''
                                                   ]);
                            $url = Url::to(['venta/print','op'=>'orden','id'=>$model->idOrdenCTP]);
                            return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                        },
                    ]
                ],
            ];
            //Pjax::begin(['id'=>'pendientes']);
            echo GridView::widget([
                                      'dataProvider'=> $data,
                                      //'filterModel' => $searchModel,
                                      'columns' => $columns,
                                      'responsive'=>true,
                                      'hover'=>true
                                  ]);
            //Pjax::end();
        ?>
    </div>
</div>

<?php
    $script = <<< JS
    $(document).ready(function() {
    setInterval(function(){ $.pjax.reload({container:"#pendientes"}); }, 30000);
});

JS;
    $this->registerJs($script);

