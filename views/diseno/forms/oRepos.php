<?php
use kartik\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin(
    ['layout' => 'horizontal','id'=>'form','action'=>\yii\helpers\Url::to(['diseno/reposicion','tipo'=>$tipo])]
); ?>
<?= Html::hiddenInput('idParent',$idParent) ?>
    <div class="row">
        <div class="col-xs-6">
            <?=
            $form->field($orden, 'tipoRepos', ['template' => '<div class="col-xs-6">{label}</div><div class="col-xs-6">{input}{error}{hint}</div>'])
                ->dropDownList(\app\components\SGOperation::tiposReposicion(),['prompt'=>'Seleccione el Error'])
                ->label("Tipo_Falla")
            ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($orden, 'attribuible',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50])->label('Atribuible') ?>
        </div>
        <div class="col-xs-6">
            <?= $form->field($orden, 'responsable',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50]) ?>
        </div>

    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Datos de Orden</strong>
        </div>
        <?= $this->render('detalleOrden',['detalle'=>$detalle,'orden'=>$orden]);?>
    </div>
<?= $form->field($orden, 'observaciones')->textArea(); ?>
    <div class="form-group">
        <div class="text-center">
            <?= Html::a( Html::icon('floppy-remove').' Cancelar', "#", ['class' => 'btn btn-default','onClick'=>'previous()']); ?>
            <?= Html::a( Html::icon('floppy-disk').' Guardar', "#", ['class' => 'btn btn-success','onClick'=>'save()']); ?>
        </div>
    </div>
<?php
ActiveForm::end();

echo $this->render('@app/views/share/scripts/save');
echo $this->render('@app/views/share/scripts/reset');