<?php
use yii\helpers\Html;
use yii\helpers\Url;

$sucursal = \app\models\Sucursal::findOne(Yii::$app->user->identity->fk_idSucursal);
if(!empty($sucursal->sucursals))
{
    $reposType =[
        'Nueva Reposicion',
        'Reposicion de Cliente',
        'Reposicion de una Interna',
        'Reposicion de Sucursales'
    ];
}
else
{
    $reposType =[
        'Nueva Reposicion',
        'Reposicion de Cliente',
        'Reposicion de una Interna'
    ];
}
?>
<div class="form-group">
    <?= Html::label('Seleccione Tipo de Repocicion',null,['class'=>'form-label'])?>
    <?= Html::dropDownList('tipo',
        $tipo,
        $reposType,
        [
            'prompt'=>'Seleccione una opcion',
            'class'=>'form-control',
            'onChange'=>'select(this.value,"'.Url::to(['diseno/reposicion']).'")',
        ])
    ?>
</div>