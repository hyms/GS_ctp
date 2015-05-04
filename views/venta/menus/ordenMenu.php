<?php
use yii\bootstrap\Nav;

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

    ],
]);
