<?php
    use kartik\helpers\Html;
    use yii\helpers\Url;

?>

<div class="row">
    <div class="text-center">
        <?= Html::img(Yii::$app->request->baseUrl . "/images/logoSingular.png") ?>
    </div>


    <?= Html::pageHeader('Funciones del sistema'); ?>

    <div class="row">
        <div class="col-md-3">
            <?= Html::a('Administracion',['/admin/index'],['class'=>'btn btn-primary btn-lg btn-block','disabled'=>(Yii::$app->user->identity->role > 2)])?>
        </div>
        <div class="col-md-3">
            <?= Html::a('Diseño',['/diseno/index'],['class'=>'btn btn-primary btn-lg btn-block','disabled'=>(Yii::$app->user->identity->role > 2 && Yii::$app->user->identity->role != 5 && Yii::$app->user->identity->role != 4)])?>
        </div>
        <div class="col-md-3">
            <?= Html::a('Ventas',['/venta/index'],['class'=>'btn btn-primary btn-lg btn-block','disabled'=>(Yii::$app->user->identity->role > 3 && Yii::$app->user->identity->role != 6)])?>
        </div>
        <div class="col-md-3">
            <?= Html::a('Imprenta',['/imprenta/index'],['class'=>'btn btn-primary btn-lg btn-block','disabled'=>(Yii::$app->user->identity->role > 3 && Yii::$app->user->identity->role != 6)])?>
        </div>
    </div>

    <?= Html::pageHeader('Comunicación'); ?>
    <div class="row">
        <div class="col-md-3">
            <?= Html::a('Correo Electronico',Url::to('http://correo.graficasingular.com'),['class'=>'btn btn-primary btn-lg btn-block'])?>
        </div>
        <div class="col-md-3">
            <?= Html::a('Chat',Url::to('http://chat.graficasingular.com'),['class'=>'btn btn-primary btn-lg btn-block'])?>
        </div>
    </div>

</div>
