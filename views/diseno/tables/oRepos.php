<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
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
        'header'=>'Fecha',
        'attribute'=>'fechaGenerada',
    ],
    [
        'header'=>'',
        'format' => 'raw',
        'value'=> function ($model) use ($tipo) {
            //return Html::a("<i class=\"glyphicon glyphicon-pencil\"></i>",["orden/modificar","id"=>$model->idOrdenCtp],['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
            return Html::a('<i class="glyphicon glyphicon-plus"></i>','#',
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
];
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
