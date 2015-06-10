<?php
    use yii\bootstrap\ActiveForm;

?>
<div class="row">
    <div class="row">
        <?php
            if(!empty($deposito)){
                ?>
                <div class = "col-xs-4">
                    <h3>En deposito</h3>
                    <div class="form-group">
                        <label class="control-label">Cantidad</label>
                        <span class="form-control"><?= $deposito->cantidad ?></span>
                    </div>
                </div>
            <?php
            }
        ?>
        <div class = "col-xs-4">
            <h3>En existencia</h3>
            <div class="form-group">
                <label class="control-label">Cantidad</label>
                <span class="form-control"><?= $almacen->cantidad ?></span>
            </div>
        </div>
        <?php $form = ActiveForm::begin(['id'=>'form']); ?>

        <div class="col-xs-4">
            <h3>Añadir a stock</h3>
            <?= $form->field($model, 'cantidad')?>
        </div>
    </div>
    <?= $form->field($model, 'observaciones')->textarea()?>
    <?php ActiveForm::end(); ?>
</div>