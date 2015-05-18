<?php
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
            /*$data =  new ActiveDataProvider([
                                                'query'      => $orden,
                                                'pagination' => [
                                                    'pageSize' => 10,
                                                ],
                                            ]);
*/
            $columns = [
                [
                    'header'=>'Correlativo',
                    'attribute'=>'correlativo',
                ],
                [
                    'header'=>'Codigo',
                    'attribute'=>'codigoServicio',
                ],
                [
                    'header'=>'Cliente',
                    'attribute'=>function($model){
                        if(empty($model->fkIdCliente))
                            return "";
                        return $model->fkIdCliente->nombreNegocio;
                    },
                ],
                [
                    'header'=>'Responsable',
                    'attribute'=>'responsable',
                ],
                [
                    'header'=>'Fecha Generada',
                    'attribute'=>'fechaGenerada',
                ],
                [
                    'header'=>'Fecha Venta',
                    'attribute'=>'fechaCobro',
                ],
                [
                    'class'=>'kartik\grid\EditableColumn',
                    'attribute'=>'factura',
                    'editableOptions'=>[
                        'header'=>'Factura',
                        'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                        'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                    ],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{update} {aviso} {print} {factura}',
                    'buttons'=>[
                        'update'=>function($url,$model){
                            $options = array_merge([
                                                       //'class'=>'btn btn-success',
                                                       'data-original-title'=>'Modificar',
                                                       'data-toggle'=>'tooltip',
                                                       'title'=>''
                                                   ]);
                            $url = Url::to(['venta/venta','id'=>$model->idOrdenCTP]);
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
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
            echo GridView::widget([
                                      'dataProvider'=> $orden,
                                      'filterModel' => $search,
                                      'columns' => $columns,
                                      'responsive'=>true,
                                      'condensed'=>true,
                                      'hover'=>true,
                                      'bordered'=>false,
                                  ]);
            /*
                array(
                    'header'=>'',
                    'class'=>'booster.widgets.TbButtonColumn',
                    'template'=>'{update} {aviso} {print} {factura}',
                    'buttons'=>array(
                        'aviso'=>
                            array(
                                'url'=>'"#"',
                                'label'=>'Anulado',
                                'icon'=>"pencil",
                                'visible'=>'$data->estado < 0',
                                'options'=>array('onclick'=>'alert("ANULADO")'),
                            ),
                    ),
                ),
            );
            //*/
        ?>
    </div>
</div>