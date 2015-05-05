<?php
    use yii\bootstrap\Nav;

    $items = [];
foreach($submenu as $key => $item)
{
    array_push($items,[
        'label' =>  $item->nombre,
        'url'   =>  ['admin/costo','op'=>'list','id'=>$item->idSucursal]
    ]);
}

echo Nav::widget([
    'options'   =>  ['class' => 'nav-tabs'],
    'items'     =>  $items
]);