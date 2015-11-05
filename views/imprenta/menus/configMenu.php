<?php
use kartik\widgets\SideNav;

echo SideNav::widget([
    'type' => SideNav::TYPE_PRIMARY,
    'encodeLabels' => false,
    'heading' => false,
    'items' => [
        [
            'label'=>'Crear Items',
            'url'=>['imprenta/config','op'=>'']
        ],
        [
            'label'=>'Armar',
            'url'=>['imprenta/config','op'=>'']
        ],
        [
            'label'=>'Lista Secuencias',
            'url'=>['imprenta/config','op'=>'']
        ],
    ],
]);
