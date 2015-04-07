<?php
use yii\bootstrap\Nav;

?>
    <?php
    echo Nav::widget([
        'items' => [
            [
                'label' => 'Cliente',
                'url' => ['diseno/orden','op'=>'cliente'],
            ],
            [
                'label' => 'Internas',
                'url' => ['diseno/orden','op'=>'interna'],
            ],
            [
                'label' => 'Reposiciones',
                'url' => ['diseno/orden','op'=>'repos'],
            ],
            [
                'label' => 'Buscar Orden',
                'url' => ['diseno/orden','op'=>'buscar'],
            ],
        ],
        'options' => ['class' =>'nav-tabs'],
        //'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
    ]);
    ?>
