<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

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
            'attribute'=>'nombreCliente',
            'value'=>function($model){
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
            'header'=>'Fecha Venta',
            'attribute'=>'fechaCobro',
        ],
        [
            'header'=>'Fecha Plazo',
            'attribute'=>'fechaPlazo',
        ],
        [
            'header'=>'Saldo',
            'attribute'=>function($model){
                $pagado = \app\models\MovimientoCaja::findOne(['idMovimientoCaja'=>$model->fk_idMovimientoCaja]);
                $montos = \app\models\MovimientoCaja::findAll(['idParent'=>$pagado->idMovimientoCaja]);
                $pagado = $pagado->monto;
                foreach($montos as $item)
                {
                    $pagado += $item->monto;
                }
                return ($model->montoVenta-$pagado);
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update} {cancel}',
            'buttons'=>[
                'update'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Modificar',
                                               'data-toggle'=>'tooltip',
                                               'title'=>''
                                           ]);
                    $url = Url::to(['venta/venta','id'=>$model->idOrdenCTP]);
                    return Html::a(Html::icon('pencil'), $url, $options);
                },
                'cancel'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Cancelar Deuda',
                                               'data-toggle'=>'tooltip',
                                               'title'=>''
                                           ]);
                    $url = Url::to(['venta/pagodeuda','id'=>$model->idOrdenCTP]);
                    return Html::a(Html::icon('usd'), $url, $options);
                },
            ]
        ],
    ];

    Pjax::begin();
    echo GridView::widget([
                              'dataProvider'=> $orden,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'responsive'=>true,
                              'hover'=>true,
                              'bordered'=>false,
                              'toolbar' => [],
                              'panel' => [
                                  'heading'=>Html::tag('strong','Deudores'),
                                  'type'=>GridView::TYPE_DEFAULT,
                              ],
                          ]);
    Pjax::end();
