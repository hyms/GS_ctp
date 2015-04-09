<div class="col-xs-12">
    <h3 class="text-center"><?php echo ($model->tipoRecibo)?"Egreso":"Ingreso"; ?></h3>
    <?php $form = $this->beginWidget(
        'booster.widgets.TbActiveForm',
        array(
            'id' => 'form',
            'type' => 'horizontal',
        )
    );
    ?>

    <div class="row">
        <div class="col-xs-6">
            <?php echo $form->textFieldGroup($model, 'nombre'); ?>
        </div>
        <div class="col-xs-6">
            <?php echo $form->textFieldGroup($model, 'ciNit'); ?>
        </div>
    </div>

    <?php echo $form->textAreaGroup($model, 'detalle'); ?>

    <div class="row" >
        <div class="col-xs-4" >
            <?php echo $form->textFieldGroup($model, 'monto'); ?>
        </div>
        <div class="col-xs-4" >
            <?php echo $form->textFieldGroup($model, 'acuenta'); ?>
        </div>
        <div class="col-xs-4" >
            <?php echo $form->textFieldGroup($model, 'saldo'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>