<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

    <div class="caja-form">

        <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
        <?= $form->field($orden, 'responsable')->textInput(['maxlength' => 50]) ?>
        <div class="form-group">
            <?= Html::submitButton($orden->isNewRecord ? 'Guardar' : 'Modificar', ['class' => $orden->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
<?php
//$this->renderPartial('/scripts/cliente');
