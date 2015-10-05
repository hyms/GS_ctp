<?php
    use yii\bootstrap\Nav;

    $items = [
        [
            'label' =>  'Tipos de Trabajo',
            'url'   =>  ['admin/config','op'=>'imprenta','imp'=>'tdt']
        ],
        [
            'label' =>  'Parametros',
            'url'   =>  ['admin/config','op'=>'imprenta','imp'=>'par']
        ],
        [
            'label' =>  'Productos',
            'url'   =>  ['admin/config','op'=>'imprenta','imp'=>'pro']
        ],
        [
            'label' =>  'Diseño',
            'url'   =>  ['admin/config','op'=>'imprenta','imp'=>'dis']
        ],
        [
            'label' =>  'Acabado',
            'url'   =>  ['admin/config','op'=>'imprenta','imp'=>'acb']
        ],
    ];

    echo Nav::widget([
                         'options'   =>  ['class' => 'nav-tabs'],
                         'items'     =>  $items
                     ]);