<?php
    use yii\bootstrap\Nav;

?>
    <?php
    echo Nav::widget([
        'items' => [
            [
                'label' => 'Nueva Reposicion',
                'url' => ['diseno/reposicion','op'=>'nueva'],
            ],
            [
                'label' => 'Buscar Reposicion',
                'url' => ['diseno/reposicion','op'=>'list'],
            ],
        ],
        'options' => ['class' =>'nav-tabs'],
        //'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
    ]);
    ?>
