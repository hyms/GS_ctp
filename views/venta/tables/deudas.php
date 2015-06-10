<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Historial de Pagos de Deudas</strong>
    </div>
    <?php
        $columns=[
            [
                'header'=>'Orden',
                'attribute'=>function($model)
                {
                    if(empty($model->idParent0))
                        return "";
                    return $model->idParent0->ordenCTPs[0]->correlativo;
                }
            ],
            [
                'header'=>'Cliente',
                'attribute'=>function($model)
                {
                    if(empty($model->idParent0))
                        return "";
                    if(empty($model->idParent0->ordenCTPs[0]->fkIdCliente))
                        return "";
                    return $model->idParent0->ordenCTPs[0]->fkIdCliente->nombreNegocio;
                }

            ],
            [
                'header'=>'Responsable',
                'attribute'=>function($model)
                {
                    if(empty($model->idParent0))
                        return "";
                    return $model->idParent0->ordenCTPs[0]->responsable;
                }

            ],
            [
                'header'=>'Pagado',
                'attribute'=>function($model) {
                    $tmp = \app\models\MovimientoCaja::findOne(['idMovimientoCaja' => $model->idParent0->ordenCTPs[0]->fk_idMovimientoCaja]);
                    if (!empty($tmp->movimientoCajas)) {
                        $c = count($tmp->movimientoCajas);
                        for ($i = 0; $i < ($c-1); ++$i) {
                            $tmp->monto += $tmp->movimientoCajas[$i]->monto;
                        }
                    }
                    return $tmp->monto;
                }
            ],
            [
                'header'=>'A/C',
                'attribute'=>'monto',
            ],
            [
                'header'=>'Saldo',
                'attribute'=>function($model)
                {
                    $tmp = \app\models\MovimientoCaja::findOne(['idMovimientoCaja' => $model->idParent0->ordenCTPs[0]->fk_idMovimientoCaja]);
                    if (!empty($tmp->movimientoCajas)) {
                        $c = count($tmp->movimientoCajas);
                        for ($i = 0; $i < ($c-1); ++$i) {
                            $tmp->monto += $tmp->movimientoCajas[$i]->monto;
                        }
                    };
                    return ($model->idParent0->ordenCTPs[0]->montoVenta-($tmp->monto+$model->monto));
                },
            ],
            [
                'header'=>'Fecha',
                'attribute'=>'time',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {print}',
                'buttons'=>[
                    'update'=>function($url,$model){
                        $options = array_merge([
                                                   //'class'=>'btn btn-success',
                                                   'data-original-title'=>'Cancelar Deuda',
                                                   'data-toggle'=>'tooltip',
                                                   'title'=>''
                                               ]);
                        $url = Url::to(['venta/pagodeuda','id'=>$model->idParent0->ordenCTPs[0]->idOrdenCTP,'deuda'=>$model->idMovimientoCaja]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                    'print'=>function($url,$model){
                        $options = array_merge([
                                                   //'class'=>'btn btn-success',
                                                   'data-original-title'=>'Imprimir',
                                                   'data-toggle'=>'tooltip',
                                                   'title'=>''
                                               ]);
                        $url =Url::to(['venta/print','op'=>'deuda','id'=>$model->idMovimientoCaja]);
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                    },
                ]
            ],
        ];
        echo GridView::widget([
                                  'dataProvider'=> $deudas,
                                  'filterModel' => $search,
                                  'columns' => $columns,
                                  'responsive'=>true,
                                  'condensed'=>true,
                                  'hover'=>true,
                                  'bordered'=>false,
                              ]);
    ?>
</div>