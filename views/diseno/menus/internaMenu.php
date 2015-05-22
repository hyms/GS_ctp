<?php
    use kartik\widgets\SideNav;

    echo SideNav::widget([
                             'type' => SideNav::TYPE_PRIMARY,
                             'encodeLabels' => false,
                             'heading' => false,
                             'items' => [
                                 [
                                     'label' => 'Nueva Orden',
                                     'url' => ['diseno/interna','op'=>'nueva'],
                                 ],
                                 [
                                     'label' => 'Buscar O. Interna',
                                     'url' => ['diseno/interna','op'=>'list'],
                                 ],
                                 [
                                     'label' => 'Notas',
                                     'url' => ['diseno/interna','op'=>'nota'],
                                 ],
                             ],
                         ]);
