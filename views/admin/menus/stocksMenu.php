<?php
    use yii\bootstrap\Nav;

    $items = [
        [
            'label'=>'Deposito',
            'url'=> ['admin/stock','op'=>'list','id'=>0]
        ]
    ];
    foreach($submenu as $key => $item)
    {
        array_push($items,[
            'label' =>  $item->nombre,
            'url'   =>  ['admin/stock','op'=>'list','id'=>$item->idSucursal]
        ]);
    }

    echo Nav::widget([
                         'options'   =>  ['class' => 'nav-tabs'],
                         'items'     =>  $items
                     ]);