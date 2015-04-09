<h2>Orden: <small><?php echo $orden; ?></small></h2>
<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'form',
        'type' => 'horizontal',
    )
);
?>
<div class="col-xs-12">
    <h3>Añadir Nro Factura</h3>
    <div class="row">
        <?php echo $form->textFieldGroup($model, 'codigo'); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
