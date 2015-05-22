<?php
    use kartik\widgets\SideNav;

    echo SideNav::widget([
                             'type' => SideNav::TYPE_PRIMARY,
                             'encodeLabels' => false,
                             'heading' => false,
                             'items' => [
                                 [
                                     'label' => 'Nueva Reposicion',
                                     'url' => ['diseno/reposicion','op'=>'nueva'],
                                 ],
                                 [
                                     'label' => 'Buscar Reposicion',
                                     'url' => ['diseno/reposicion','op'=>'list'],
                                 ],
                                 [
                                     'label' => 'Notas',
                                     'url' => ['diseno/reposicion','op'=>'nota'],
                                 ]
                             ],
                         ]);