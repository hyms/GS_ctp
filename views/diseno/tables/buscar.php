<?php
    use kartik\grid\GridView;

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
