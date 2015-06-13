<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

    echo '<div class="list-group">';
    foreach($producto->getModels() as $key => $model)
    {
		echo Html::a($model->fkIdProducto->formato." ".$model->fkIdProducto->dimension,'#',
                     [
                         'onclick'=>'newRow('.$model->idProductoStock.',"'. Url::toRoute('add_detalle').'",'.$tipo.');return false;',
                         'class'=>'list-group-item'.((($key % 2)==0)?' list-group-item-info':''),
                         'data-original-title'=>'Añadir',
                         'data-toggle'=>'tooltip',
                         'title'=>''
                     ]
        );
    }
    echo '</div>';
    /*$columns = [
        [
            'header'=>'Placas',
            'format'=>'raw',
            'value'=>function($model)use ($tipo){
                return Html::a($model->fkIdProducto->formato." ".$model->fkIdProducto->dimension,'#',
                               [
                                   'onclick'=>'newRow('.$model->idProductoStock.',"'. Url::toRoute('add_detalle').'",'.$tipo.');return false;',
                                   'class'=>'list-group-item',
                                   'data-original-title'=>'Añadir',
                                   'data-toggle'=>'tooltip',
                                   'title'=>''
                               ]
                );
                //return $model->fkIdProducto->formato."<br>".$model->fkIdProducto->dimension;
            },
        ],
        /*[
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
                          ]);*/
?>
<?= $this->render('../scripts/addList'); ?>
