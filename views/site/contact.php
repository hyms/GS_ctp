<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<div class="row">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success')?>
    </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('error')?>
    </div>
    <?php endif; ?>
    <div class="col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'to')->dropDownList(ArrayHelper::map(\app\models\ContactForm::correos(),'correo','nombre'),['prompt'=>'Seleccione Destinatario']) ?>
                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
    </div>

</div>
