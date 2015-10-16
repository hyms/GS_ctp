<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    $form = ActiveForm::begin(['id'=>'form']);
?>
    <div class="row">
        <?= Html::tag('div',
                      $form->field($recibo,'nombre'),
                      ['class'=>'col-md-6'])?>
        <?= Html::tag('div',
                      $form->field($recibo,'ciNit'),
                      ['class'=>'col-md-6'])?>
        <?= Html::tag('div',
                      $form->field($recibo,'detalle')->textarea(),
                      ['class'=>'col-md-12'])?>
        <?= Html::tag('div',
                      $form->field($recibo,'monto'),
                      ['class'=>'col-md-4'])?>
    </div>
<?php ActiveForm::end(); ?>