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
        [
            'label'=>'H. Pago de Deudas',
            'url'=>['venta/orden','op'=>'deudas']
        ],
        [
            'label'=>'Ventas Realizadas',
            'url'=>['venta/orden','op'=>'diario']
        ],
        [
            'label'=>'Recibos',
            'url'=>['venta/recibos']
        ],
    ],
]);
