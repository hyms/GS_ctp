<?php
    use kartik\widgets\SideNav;

    $items = [];

    /*    array_push($items, [
            'label' => 'Recibos',
            'url'   => ['admin/arqueos', 'op' => 'recibo']
        ]);
        array_push($items, [
            'label' => 'Caja Chica',
            'url'   => ['admin/arqueos', 'op' => 'chica']
        ]);*/
    array_push($items,[
        'label'=>'Arqueo',
        'url'=>['admin/arqueos','op'=>'arqueo']
    ]);
    array_push($items, [
        'label' => 'Historial Arqueos',
        'url'   => ['admin/arqueos', 'op' => 'arqueos']
    ]);
    array_push($items, [
        'label' => 'Calcular Montos',
        'url'   => ['admin/arqueos', 'op' => 'calc']
    ]);
    echo SideNav::widget([
                             'type' => SideNav::TYPE_PRIMARY,
                             'encodeLabels' => false,
                             'heading' => false,
                             'items' => $items,
                         ]);
