<?php
use kartik\widgets\Affix;

/* @var $this yii\web\View */
    $this->title = 'Servicios';

    $ctp="Pre-Prensa CTP";

    $imprenta="Imprenta";

    $flexografia="Flexografia";

    $icon = 'arrow-right';
    $items = [
        [
            'url' => '#ctp',
            'label' => 'Pre-Prensa CTP',
            'icon' => 'circle-arrow-right',
            'content' => $ctp,
        ],
        [
            'url' => '#imp',
            'label' => 'Imprenta',
            'icon' => 'circle-arrow-right',
            'content' => $imprenta,
        ],
        [
            'url' => '#flex',
            'label' => 'Flexografia',
            'icon' => 'circle-arrow-right',
            'content' => $flexografia,
        ],
    ];
    /* Display both menu and body aside each other */
?>
<div class="row">
    <div class="col-xs-3">
        <?php
            echo Affix::widget([
                                   'type' => 'menu',
                                   'items' => $items
                               ]);?>
    </div>
    <div class="col-xs-9">
        <?php
            echo Affix::widget([
                                   'type' => 'body',
                                   'items' => $items
                               ]);?>
    </div>
</div>

