<?php
    use kartik\widgets\SideNav;

    echo SideNav::widget([
                             'type' => SideNav::TYPE_PRIMARY,
                             'encodeLabels' => false,
                             'heading' => false,
                             'items' => [
                                 [
                                     'label' => 'Listar Productos',
                                     'url' => ['admin/producto','op'=>'list'],
                                 ],
                                 [
                                     'label' => 'Nuevo Productos',
                                     'url' => ['admin/producto','op'=>'new'],
                                 ],
                                 [
                                     'label' => 'Añadir a Almacen',
                                     'url' => ['admin/producto','op'=>'add'],
                                 ],
                                 [
                                     'label' => 'Stocks',
                                     'url' => ['admin/stock'],
                                 ],
                                 [
                                     'label' => 'Costos',
                                     'url' => ['admin/costo'],
                                 ],
                             ],
                         ]);
