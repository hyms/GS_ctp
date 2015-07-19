<?php
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de Trabajo - Transaccionadas</strong>
    </div>
    <div>
        <?php
            $columns = [];
            array_push($columns,[
                'header'=>'Correlativo',
                'attribute'=>'correlativo',
            ]);
            array_push($columns,[
                'header'=>'Codigo',
                'attribute'=>'codigoServicio',
            ]);
            array_push($columns,[
                'header'=>'Cliente',
                'attribute'=>'nombreCliente',
                'value'=>function($model){
                    if(empty($model->fkIdCliente))
                        return "";
                    return $model->fkIdCliente->nombreNegocio;
                },
            ]);
            array_push($columns, [
                'header'=>'Responsable',
                'attribute'=>'responsable',
            ]);
            array_push($columns, [
                'header'=>'Fecha Generada',
                'attribute'=>'fechaGenerada',
            ]);
            array_push($columns, [
                'header'=>'Fecha Venta',
                'attribute'=>'fechaCobro',
            ]);
            array_push($columns, [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'factura',
                'editableOptions'=>[
                    'header'=>'Factura',
                    'inputType'=>Editable::INPUT_TEXT,
                    'format' => Editable::FORMAT_BUTTON,
                    'size'=>'md',
                ],
            ]);
            array_push($columns, [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {anular} {print}',
                'buttons'=>[
                    'update'=>function($url,$model){
                        $options = array_merge([
                                                   //'class'=>'btn btn-success',
                                                   'data-original-title'=>'Modificar',
                                                   'data-toggle'=>'tooltip',
                                                   'title'=>''
                                               ]);
                        $url = Url::to(['venta/venta','id'=>$model->idOrdenCTP]);
                        if(empty($model->fechaCierre))
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                        else
                            return "";
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
            ]);
            echo GridView::widget([
                                      'dataProvider'=> $orden,
                                      'filterModel' => $search,
                                      'columns' => $columns,
                                      'responsive'=>true,
                                      'condensed'=>true,
                                      'hover'=>true,
                                      'bordered'=>false,
                                  ]);
        ?>
    </div>
</div>