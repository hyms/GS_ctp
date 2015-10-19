<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<div class="row">
    <?php $form = ActiveForm::begin(['id'=>'form']); ?>
    <?= Html::tag('div',
        $form->field($model, 'nombre'),
        ['class'=>'col-md-6']);?>
    <?= Html::tag('div',
        $form->field($model, 'descripcion')->textarea(),
        ['class'=>'col-md-12']);?>
    <?= Html::tag('div',
        $$form->field($model, 'fk_idSucursal')->dropDownList(ArrayHelper::map(($model->isNewRecord)?\app\models\Sucursal::find()->all():\app\models\Sucursal::find()->where(['!=','idSucursal',$model->idSucursal])->all(),'idSucursal','nombre'),['prompt'=>''])->label('Sucursal'),
        ['class'=>'col-md-6']);?>
    <?= Html::tag('div',
        $form->field($model, 'fk_idCaja')->dropDownList(ArrayHelper::map(($model->isNewRecord)?\app\models\Sucursal::find()->all():\app\models\Sucursal::find()->where(['!=','idSucursal',$model->idSucursal])->all(),'idSucursal','nombre'),['prompt'=>''])->label('Depende de'),
        ['class'=>'col-md-6']);?>
    <?= Html::tag('div',
        $form->field($model, 'enable')->checkbox(),
        ['class'=>'col-md-4']);?>

    <?php ActiveForm::end(); ?>
</div><!-- sucursal -->
