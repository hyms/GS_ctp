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
