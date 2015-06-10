<?php
/* @var $this yii\web\View */
$this->title = 'Diseño';
?>
<h1>Bienvenido <span class="label label-primary"><?= Yii::$app->user->identity->nombre;?> <?= Yii::$app->user->identity->apellido;?></span></h1>
<br>
<div class="col-xs-4">
    <h3>Ordenes</h3>
    <?= $this->render('tables/notasPendientes', ['notas' => $notas1]);?>
</div>
<div class="col-xs-4">
    <h3>Internas</h3>
    <?= $this->render('tables/notasPendientes', ['notas' => $notas2]);?>
</div>
<div class="col-xs-4">
    <h3>Repocicion</h3>
    <?= $this->render('tables/notasPendientes', ['notas' => $notas3]);?>
</div>