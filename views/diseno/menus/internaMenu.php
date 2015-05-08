<?php
    use yii\bootstrap\Nav;

?>
    <?php
    echo Nav::widget([
        'items' => [
            [
                'label' => 'Nueva Orden',
                'url' => ['diseno/interna','op'=>'nueva'],
            ],
            [
                'label' => 'Buscar Orden Interna',
                'url' => ['diseno/interna','op'=>'list'],
            ],
        ],
        'options' => ['class' =>'nav-tabs'],
        //'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
    ]);
    ?>
