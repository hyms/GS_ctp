<?php
    use kartik\widgets\SideNav;

    $items = [];

    if(Yii::$app->user->identity->role != 6) {
        array_push($items, [
            'label' => 'Recibos',
            'url'   => ['venta/caja', 'op' => 'recibo']
        ]);
        array_push($items, [
            'label' => 'Caja Chica',
            'url'   => ['venta/caja', 'op' => 'chica']
        ]);
    }
    array_push($items,[
        'label'=>'Arqueo',
        'url'=>['venta/caja','op'=>'arqueo']
    ]);
    if(Yii::$app->user->identity->role != 6) {
        array_push($items, [
            'label' => 'Historial Arqueos',
            'url'   => ['venta/caja', 'op' => 'arqueos']
        ]);
    }
    echo SideNav::widget([
                             'type' => SideNav::TYPE_PRIMARY,
                             'encodeLabels' => false,
                             'heading' => false,
                             'items' => $items,
                         ]);
