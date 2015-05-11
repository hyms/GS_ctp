<?php

    use kartik\widgets\SideNav;

    echo SideNav::widget([
                             'type' => SideNav::TYPE_PRIMARY,
                             'encodeLabels' => false,
                             'heading' => false,
                             'items' => [
                                 [
                                     'label'=>'Recibos',
                                     'url'=>['venta/caja','op'=>'recibo']
                                 ],
                                 [
                                     'label'=>'Caja Chica',
                                     'url'=>['venta/caja','op'=>'chica']
                                 ],
                                 [
                                     'label'=>'Arqueo',
                                     'url'=>['venta/caja','op'=>'arqueo']
                                 ],
                                 [
                                     'label'=>'Arqueos',
                                     'url'=>['venta/caja','op'=>'arqueos']
                                 ],
                             ],
                         ]);

/*use yii\bootstrap\Nav;

echo Nav::widget([
    'options' => ['class' => 'nav-tabs'],
    'items' => [
        [
            'label'=>'Pendientes',
            'url'=>['venta/orden','op'=>'pendiente']
        ],
        [
            'label'=>'Buscar',
            'url'=>['venta/orden','op'=>'buscar']
        ],
        [
            'label'=>'Ventas Realizadas',
            'url'=>['venta/orden','op'=>'diario']
        ],
        [
            'label'=>'Deudores',
            'url'=>['venta/deuda','op'=>'deuda']
        ],
        [
            'label'=>'H. Pago de Deudas',
            'url'=>['venta/deuda','op'=>'deudas']
        ],

    ],
]);*/
