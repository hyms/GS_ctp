<?php
use kartik\widgets\SideNav;

echo SideNav::widget([
    'type' => SideNav::TYPE_PRIMARY,
    'encodeLabels' => false,
    'heading' => false,
    'items' => [
        [
            'label'=>'Crear Items',
            'url'=>['imprenta/config','op'=>'newi']
        ],
        [
            'label'=>'Armar',
            'url'=>['imprenta/config','op'=>'link']
        ],
        [
            'label'=>'Lista Secuencias',
            'url'=>['imprenta/config','op'=>'list']
        ],
    ],
]);
