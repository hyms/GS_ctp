<?php
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Alert;
    use yii\helpers\Html;

?>
<div class="well">
    <h3>Datos Personales</h3>
    <?php if(Yii::$app->session->hasFlash('error')) {
        echo Alert::widget([
                               'options' => [
                                   'class' => 'alert-danger',
                               ],
                               'body'    => Yii::$app->session->getFlash('error'),
                           ]);
    }
    ?>
    <?php if(Yii::$app->session->hasFlash('success')){
        echo Alert::widget([
                               'options' => [
                                   'class' => 'alert-success',
                               ],
                               'body'    => Yii::$app->session->getFlash('success'),
                           ]);
    }
    ?>
    <?php $form = ActiveForm::begin(['id'=>'form']); ?>
    <div class="row">
    <div class="col-xs-6">
        <?= $form->field($model, 'username') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'nombre') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'apellido') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'CI') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'telefono') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'email') ?>
    </div>
    </div>
    <div class="form-group">
        <div class="text-center">
            <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
            <?= Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-success hidden-print','id'=>'save')); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?= $this->render('../scripts/save') ?>
<?= $this->render('../scripts/reset') ?>