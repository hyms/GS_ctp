<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

    $columns = [
        [
            'header'=>'Placas',
            'format'=>'raw',
            'value'=>function($model){
                return $model->fkIdProducto->formato."<br>".$model->fkIdProducto->dimension;
            },
        ],
        [
            'header'=>'',
            'format' => 'raw',
            'value'=> function ($model) use ($tipo) {
                //return Html::a("<i class=\"glyphicon glyphicon-pencil\"></i>",["orden/modificar","id"=>$model->idOrdenCtp],['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
                return Html::a('<i class="glyphicon glyphicon-plus"></i>','#',
                               [
                                   'onclick'=>'newRow('.$model->idProductoStock.',"'. Url::toRoute('add_detalle').'",'.$tipo.');return false;',
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
                              'dataProvider'=> $producto,
                              //'filterModel' => $search,
                              'columns' => $columns,
                              'condensed' => true,
                              'hover'=>true,
                              'bordered'=>false,
                          ]);
?>
<?= $this->render('../scripts/addList'); ?>
