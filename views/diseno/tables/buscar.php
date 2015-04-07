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
                'value'=>'$model->correlativo',
            ],
            [
                'header'=>'Codigo',
                'value'=>'$model->correlativo',
            ],
            /*[
                'header'=>'Cliente',
                'value'=>'$model->correlativo',
            ],*/
            [
                'header'=>'Responsable',
                'value'=>'$model->responsable',
            ],
            [
                'header'=>'Fecha',
                'value'=>'$model->fechaGenerada',
            ],
            [
                'header'=>'',
                'value'=>function($model){
                    return \yii\helpers\Html::a("<i class=\"glyphicon glyphicon-pencil\"></i>",["orden/modificar","id"=>$model->idOrdenCtp],['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
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
