<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'options' => ['class' => 'nav-tabs'],
    'items' => [
        [
            'label'=>'Deudores',
            'url'=>['venta/deuda','op'=>'deuda']
        ],
        [
            'label'=>'H. Pago de Deudas',
            'url'=>['venta/deuda','op'=>'deudas']
        ],
    ],
]);
