<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'header'=>'Formato',
            'value'=>function($model){
                return $model->fkIdProducto->color;
            },
            //'attribute'=>'color',
            //'filter'=>CHtml::activeTextField($producto, 'codigo',array("class"=>"form-control")),
        ],
        [
            'header'=>'Tamaño',
            'value'=>function($model){
                return $model->fkIdProducto->descripcion;
            },
            //'attribute'=>'descripcion',
            //'filter'=>CHtml::activeTextField($producto, 'codigoPersonalizado',array("class"=>"form-control")),
        ],
        [
            'header'=>'Stock',
            'value'=>'cantidad',
            'attribute'=>'cantidad',
            //'filter'=>CHtml::activeDropDownList($producto,'material',CHtml::listData(Producto::model()->findAll(array('group'=>'material','select'=>'material')),'material','material'),array("class"=>"form-control",'empty'=>'')),
        ],
        //['class' => 'yii\grid\ActionColumn'],
        [
            'header'=>'',
            'format' => 'raw',
            'value'=> function ($model) {
                //return Html::a("<i class=\"glyphicon glyphicon-pencil\"></i>",["orden/modificar","id"=>$model->idOrdenCtp],['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
                return Html::a('<i class="glyphicon glyphicon-plus"></i>','#',
                    [
                        'onclick'=>'newRow('.$model->idProductoStock.',"'. Url::toRoute('add_detalle').'","cliente");return false;',
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
<?php
    echo $this->render('../scripts/addList');
    echo $this->render('../scripts/tooltip');
