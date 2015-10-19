<?php
    use kartik\widgets\SideNav;

    $items = [];

array_push($items, [
    'label' => 'Recibos',
    'url'   => ['admin/caja', 'op' => 'recibo']
]);
/*array_push($items, [
    'label' => 'Caja Chica',
    'url'   => ['admin/caja', 'op' => 'chica']
]);*/
array_push($items, [
    'label' => 'Historial traspasos',
    'url'   => ['admin/caja', 'op' => 'traspasos']
]);
echo SideNav::widget([
    'type' => SideNav::TYPE_PRIMARY,
    'encodeLabels' => false,
    'heading' => false,
    'items' => $items,
]);
