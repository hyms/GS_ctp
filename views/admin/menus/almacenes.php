<?php
    use yii\bootstrap\Nav;

    $items = [];
    foreach($submenu as $key => $item)
    {
        array_push($items,[
            'label' =>  $item->nombre,
            'url'   =>  ['admin/producto','op'=>'add','id'=>$item->idSucursal]
        ]);
    }

    echo Nav::widget([
                         'options'   =>  ['class' => 'nav-tabs'],
                         'items'     =>  $items
                     ]);