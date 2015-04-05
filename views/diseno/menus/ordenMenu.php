<?php
use yii\bootstrap\Nav;
?>

<div class="well well-sm hidden-print">
    <?php
    echo Nav::widget([
        'items' => [
            [
                'label' => 'Cliente',
                'url' => ['diseno/orden','op'=>'cliente'],
            ],
            '<li class="divider"></li>',
            [
                'label' => 'Buscar Orden',
                'url' => ['diseno/orden','op'=>'buscar'],
            ],
        ],
        'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
    ]);
    ?>
</div>