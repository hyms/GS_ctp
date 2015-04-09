<div class="col-xs-12">
    <?php $form = $this->beginWidget(
        'booster.widgets.TbActiveForm',
        array(
            'id' => 'form',
            'type' => 'horizontal',
        )
    );
    ?>

    <div class="col-xs-5">
        <?php echo $form->textFieldGroup($model, 'saldo'); ?>

        <?php echo $form->textFieldGroup($model, 'monto'); ?>
    </div>

    <div class="col-xs-7">
        <?php echo $form->textAreaGroup($model, 'detalle'); ?>
        <?php echo $form->textFieldGroup($model, 'obseraciones'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>