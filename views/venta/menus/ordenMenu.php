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
            'label'=>'Deudores',
            'url'=>['venta/orden','op'=>'deuda']
        ],

    ],
]);
