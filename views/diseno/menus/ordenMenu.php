<?php
    use kartik\widgets\SideNav;

    echo SideNav::widget([
                             'type' => SideNav::TYPE_PRIMARY,
                             'encodeLabels' => false,
                             'heading' => false,
                             'items' => [
                                 [
                                     'label' => 'Nueva Orden',
                                     'url' => ['diseno/orden','op'=>'cliente'],
                                 ],
                                 [
                                     'label' => 'En Proceso',
                                     'url' => ['diseno/orden','op'=>'buscar'],
                                 ],
                                 [
                                     'label' => 'Historial',
                                     'url' => ['diseno/orden','op'=>'list'],
                                 ],
                             ],
                         ]);
