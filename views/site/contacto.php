<?php
use kartik\widgets\Affix;

/* @var $this yii\web\View */
$this->title = 'Servicios';

$ctp='
<div class="row">
<div class="col-xs-6">
<address>
<strong>La Paz</strong><br>
<strong>Direccion:</strong> C. Juan de la Riva 1567<br>
<strong>Telefono:</strong> 2901834<br>
<strong>Celular:</strong> 70186731<br>
<strong>email:</strong> ctplp@graficasingular.com<br>
</address>
</div>
<div class="col-xs-6">
<address>
<strong>El Alto</strong><br>
<strong>Direccion:</strong> C. 5 Nro. 128 (entre Moscoso y Carbajal) Villa Dolores<br>
<strong>Telefono:</strong> 2822193<br>
<strong>Celular:</strong> 79588661<br>
<strong>email:</strong> ctpea@graficasingular.com<br>
</address>
</div>
<div class="col-xs-6">
<address>
<strong>Cochabamba</strong><br>
<strong>Direccion:</strong> C. Ecuador Nro. 178, (entre Ayacucho y Junin) <br>
<strong>Telefono:</strong> 4038385<br>
<strong>Celular:</strong> 60720347<br>
<strong>email:</strong> ctpcbba@graficasingular.com<br>
</address>
</div>
<div class="col-xs-6">
<address>
<strong>Santa Cruz</strong><br>
<strong>Direccion:</strong> AV. Cañoto (casi esq. Ayacucho)<br>
<strong>Telefono:</strong> 3305401<br>
<strong>Celular:</strong> 60931880<br>
<strong>email:</strong> ctpscz@graficasingular.com<br>
</address>
</div>
</div>
';

$imprenta='
<div class="row">
<div class="col-xs-6">
<address>
<strong>La Paz</strong><br>
<strong>Direccion:</strong> C. Juan de la Riva 1567<br>
<strong>Telefono:</strong> 2204783<br>
<strong>Celular:</strong> 70652860<br>
<strong>email:</strong> imprenta@graficasingular.com<br>
</address>
</div>
</div>';

$contacto = $this->render('contact',['model'=>$model]);

$icon = 'arrow-right';
$items = [
    [
        'url' => '#ctp',
        'label' => 'Servicio Pre-Prensa CTP',
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
        'url' => '#cont',
        'label' => 'Contactanos',
        'icon' => 'circle-arrow-right',
        'content' => $contacto,
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

