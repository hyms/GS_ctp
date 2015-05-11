<?php
    use kartik\widgets\SideNav;

    echo SideNav::widget([
                             'type' => SideNav::TYPE_PRIMARY,
                             'encodeLabels' => false,
                             'heading' => false,
                             'items' => [
                                 [
                                     'label' => 'Sucursal',
                                     'url' => ['admin/config','op'=>'sucursal'],
                                 ],
                                 /*[
               'label' => 'Nuevo Productos',
               'url' => ['admin/config','op'=>'new'],
           ],
           [
               'label' => 'Añadir a Almacen',
               'url' => ['admin/config','op'=>'addProduct'],
           ]*/
                             ],
                         ]);
