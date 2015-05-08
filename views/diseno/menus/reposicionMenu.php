<?php
    use yii\bootstrap\Nav;

?>
    <?php
    echo Nav::widget([
        'items' => [
            [
                'label' => 'Nueva Reposicion',
                'url' => ['diseno/orden','op'=>'cliente'],
            ],
            [
                'label' => 'Buscar Reposicion',
                'url' => ['diseno/orden','op'=>'buscar'],
            ],
        ],
        'options' => ['class' =>'nav-tabs'],
        //'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
    ]);
    ?>
