<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    echo Html::beginTag('div',['class'=>'row']);
    $form = ActiveForm::begin(['id'=>'form']);

    echo $form->field($model, 'nameValue');
    echo $form->field($model, 'observaciones')->textarea();
    echo $form->field($model, 'enable')->checkbox();

    ActiveForm::end();
    echo Html::endTag('div');
