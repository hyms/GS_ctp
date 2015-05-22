<?php
    use yii\bootstrap\ActiveForm;

?>
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($nota,'texto')->textarea(); ?>
    <?php ActiveForm::end(); ?>
</div>
