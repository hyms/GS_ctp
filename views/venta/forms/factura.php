<?php
use yii\bootstrap\ActiveForm;

?>
<h2>Orden: <small><?= $orden->correlativo . "(" . $orden->codigoServicio . ")"; ?></small></h2>
<?php  $form = ActiveForm::begin(['id'=>'form','layout' => 'horizontal']); ?>
<h3>Añadir Nro Factura</h3>
<?= $form->field($orden, 'factura'); ?>
<?php ActiveForm::end(); ?>
