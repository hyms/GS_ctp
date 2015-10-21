<?php
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

$columns =  [];
if($tipo==3)
{
    array_push($columns,
        [
            'header'=>'Sucursal',
            'attribute'=>'nombreSucursal',
            'value'=>function($model){
                return $model->fkIdSucursal->nombre;
            },
        ]);
}
array_push($columns,
    [
        'header'=>'Correlativo',
        'attribute'=>'correlativo',
    ]);
array_push($columns,[
    'header'=>'Responsable',
    'attribute'=>'responsable',
]);
array_push($columns,[
    'header'=>'Fecha',
    'attribute'=>'fechaGenerada',
    'value'=>function($model)
    {
        return date("Y-m-d H:i",strtotime($model->fechaGenerada));
    }
]);
array_push($columns,[
        'header'=>'',
        'format' => 'raw',
        'value'=> function ($model) use ($tipo) {
            //return Html::a("<i class=\"glyphicon glyphicon-pencil\"></i>",["orden/modificar","id"=>$model->idOrdenCtp],['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
            return Html::a(Html::icon('plus'),'#',
                [
                    'onclick'=>'newOrden('.$model->idOrdenCTP.',"'. Url::toRoute('diseno/addreposicion').'",'.$tipo.');return false;',
                    'class'=>'btn btn-success',
                    'data-original-title'=>'Añadir',
                    'data-toggle'=>'tooltip',
                    'title'=>''
                ]
            );
        },
    ]
);
echo GridView::widget([
    'dataProvider'=> $ordenes,
    'filterModel' => $search,
    'columns' => $columns,
    'condensed' => true,
    'hover'=>true,
    'bordered'=>false,
]);

$script= <<< JS
function newOrden(id,url,tipo) {
    $.ajax({
        type: 'GET',
        url: url,
        data: 'id=' + id + '&tipo=' + tipo,
        dataType: 'html',
        success: function (html) {
            $("#orden").html(html);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error!');
        }
    });
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);
?>
