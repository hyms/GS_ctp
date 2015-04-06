<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

    <div class="caja-form">

        <div class="panel panel-default">
            <div class="panel-body" >
                <?php
                echo $this->render('../tables/producto',[
                    'producto'=>$producto,
                    'search'=>$search
                ]);
                ?>
            </div>
        </div>

        <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

        <?= $form->field($orden, 'responsable')->textInput(['maxlength' => 50]) ?>
        <div class="form-group">
            <?= Html::submitButton($orden->isNewRecord ? 'Guardar' : 'Modificar', ['class' => $orden->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
//$this->renderPartial('/scripts/cliente');
