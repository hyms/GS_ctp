<?php
    use kartik\grid\GridView;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo en processo</strong>
    </div>
    <div class="panel-body">
        <?php
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
                        return \yii\helpers\Html::a("<i class=\"glyphicon glyphicon-pencil\"></i>",['diseno/orden','op'=>'cliente','id'=>$model->idOrdenCTP],['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
                    },
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
