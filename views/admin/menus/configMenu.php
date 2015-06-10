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
                                 [
                                     'label' => 'Usuarios',
                                     'url' => ['admin/config','op'=>'user'],
                                 ],
                             ],
                         ]);
