<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    $columns=[
        [
            'header'=>'Orden',
            'attribute'=>'orden',
            'value'=>function($model)
            {
                if(empty($model->idParent0))
                    return "";
                return $model->idParent0->ordenCTPs[0]->correlativo;
            }
        ],
        [
            'header'=>'Cliente',
            //'attribute'=>'cliente',
            'value'=>function($model)
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
            'attribute'=>'responsable',
            'value'=>function($model)
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
            'value'=>'monto',
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
                    return Html::a(Html::icon('pencil'), $url, $options);
                },
                'print'=>function($url,$model){
                    $url =Url::to(['venta/print','op'=>'deuda','id'=>$model->idMovimientoCaja]);
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-toggle'=>'tooltip',
                                               'data-target' => "#modalPage",
                                               'title'=>'Imprimir',
                                               'onClick'=>'printView("'.$url.'")'
                                           ]);
                    return Html::a(Html::icon('print'), '#', $options);
                },
            ]
        ],
    ];

    Pjax::begin();
    echo GridView::widget([
                              'dataProvider'=> $deudas,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'responsive'=>true,
                              'hover'=>true,
                              'bordered'=>false,
                              'toolbar' => [],
                              'panel' => [
                                  'heading'=>Html::tag('strong','Historial de Pagos de Deudas'),
                                  'type'=>GridView::TYPE_DEFAULT,
                              ],
                          ]);

    Pjax::end();
    echo $this->render('@app/views/share/scripts/modalPage');
