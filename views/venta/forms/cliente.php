<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Crear Cliente';
?>
<div class="cliente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id'=>'form']); ?>

    <?= $form->field($model, 'fk_idTipoCliente')->dropDownList(ArrayHelper::map(\app\models\TipoCliente::find()->all(), 'idTipoCliente', 'nombre')) ?>

    <?= $form->field($model, 'nombreCompleto')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'nombreNegocio')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'nombreResponsable')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'correo')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'nitCi')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'codigoCliente')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'fk_idSucursal')->dropDownList(ArrayHelper::map(\app\models\Sucursal::find()->all(), 'idSucursal', 'nombre')) ?>

    <div class="form-group">
        <div class="text-center">
            <?php echo Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
            <?php echo Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-success hidden-print','id'=>'save')); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?= $this->render('../scripts/save') ?>
<?= $this->render('../scripts/reset') ?>
